<?php
/*
 * @package component borggique for Joomla! 3.x
 * @version $Id: com_borggique 1.0.0 2017-4-10 23:26:33Z $
 * @author Kian William Nowrouzian
 * @copyright (C) 2016- Kian William Nowrouzian
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of borggique.
    borggique is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    borggique is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with borggique.  If not, see <http://www.gnu.org/licenses/>.
 
*/ 
?>
<?php


defined('_JEXEC') or die;

use Joomla\Registry\Registry;
JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_borggique/models');


class PlgContentBorggique extends JPlugin
{
	protected $db;
	
	public function onContentPrepare($context, &$row, $params, $page = 0)
	{
		if($context=="mod_borggique" || $context=="com_borggique.borggique")
		{
		 $document = JFactory::getDocument();

		$mymodel = JModelLegacy::getInstance('Borggique','BorggiqueModel');
		if($context=="mod_borggique")
			$item = $mymodel->getItem($params->get("title"));
		else
		{
			$item = $mymodel->getItem($params);
		}

		
		if($context=="mod_borggique")
		{
		    if($params->get("jQuery")==1)
		    {
			  $document->addScript(JURI::Base()."components/com_borggique/assets/js/jquery.js");
		    }
		}
		else
        if($context=="com_borggique.borggique")
		{
		   if($item->params->get('lib')==1 )
           {
              $document->addScript(JURI::Base()."components/com_borggique/assets/js/jquery.js");
           }
		}
		
		
		        $document->addScript(JURI::Base()."components/com_borggique/assets/js/borgspieces.js");

		
		$document->addScript(JURI::Base()."components/com_borggique/assets/js/cube.js");


	    $noConflict = "var bq = jQuery.noConflict();";
        $document->addScriptDeclaration($noConflict);
		
		$borggiqueglobalvars = "
          var config = {};
		  var imageindex=0;
          var surfacecounter = 5;
          var generalflag=0;
		";
		
		 $document->addScriptDeclaration($borggiqueglobalvars);
		
		$slideitems = json_decode(str_replace("|qq|", "\"", $item->params->get('slides')));
        foreach($slideitems as $i=>$itm)
        { 
	      $images[]=JURI::base().$itm->imgname;	
		  $texts[]=$itm->imgtext;	
        }		
		
		if($context=="mod_borggique"):
		$formodule="
		bq(document).ready(function(){
				bq.fn.borg.setmyclass('".$params->get("moduleclass")."');
				bq('.".$params->get("moduleclass")."').borg.config({width:'".$item->params->get('image_width')."', height:'".$item->params->get('image_height')."', rows:'".$item->params->get('rows')."',  cols:'".$item->params->get('cols')."', cubespeed:'".$item->params->get('cubespeed')."',
     		imagebuildspeed:'".$item->params->get('imagebuildspeed')."', axis:'".$item->params->get('axis')."', cbc:'".$item->params->get('cubebackgroundcolor')."', dbc:'".$item->params->get('dimensionbackgroundcolor')."'});
				bq.fn.tinies.setConfig(config);
				bq('.".$params->get("moduleclass")."').borg.init();
		});";
		     $document->addScriptDeclaration($formodule);
		else:
		$forcomponent = "
		
                bq(document).ready(function(){					
		bq('.borggique').borg.config({width:'".$item->params->get('image_width')."', height:'".$item->params->get('image_height')."', rows:'".$item->params->get('rows')."',  cols:'".$item->params->get('cols')."', cubespeed:'".$item->params->get('cubespeed')."',
     		imagebuildspeed:'".$item->params->get('imagebuildspeed')."', axis:'".$item->params->get('axis')."', cbc:'".$item->params->get('cubebackgroundcolor')."', dbc:'".$item->params->get('dimensionbackgroundcolor')."'});
				   bq.fn.tinies.setConfig(config);
					bq('.borggique').borg.init(); 			
	            });
								   

				";
			$document->addScriptDeclaration($forcomponent);
		endif;
		

		$defaultvars="		
	bq.fn.borg.defaults = {};
	bq.fn.borg.defaults.images = [];
	bq.fn.borg.defaults.descs= [];
	bq.fn.borg.defaults.width=120;
	bq.fn.borg.defaults.height=180;
	bq.fn.borg.defaults.rows=6;
	bq.fn.borg.defaults.cols=10;
	bq.fn.borg.defaults.cubespeed=3000;
	bq.fn.borg.defaults.imagebuildspeed=242;
	bq.fn.borg.defaults.axis='Y';
	bq.fn.borg.defaults.cbc='#f18c00';
	bq.fn.borg.defaults.dbc='#000000';	

	var myimages = ".json_encode($images).";
	var mydescs = ".json_encode($texts).";
	for(var g=0; g<myimages.length; g++)
	{
	    bq.fn.borg.defaults.images[g] = myimages[g];	
		bq.fn.borg.defaults.descs[g] = mydescs[g];	
	}	
  ";
	
  $document->addScriptDeclaration($defaultvars);
  
  if ($item->title) :
		    echo '<h2><span class="borggique-name">';
			      echo $item->title;
			echo '</span></h2>';
   endif;  
   return true;
		}
	
	}

	
}
