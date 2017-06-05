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
  JHtml::_('jquery.framework');
  
  $params=$this->id;
  $document = JFactory::getDocument();
  $document->addStyleSheet(JURI::Base()."components/com_borggique/assets/css/borggique.css");	
	$row = "";	
                 JPluginHelper::importPlugin('content');
                 $dispatcher = JEventDispatcher::getInstance();
                 $dispatcher->trigger('onContentPrepare', array('com_borggique.borggique', &$row, &$params,0 ) );
				 
	 // $imagesize = "
		//#borggique  #surfacecontainer div div div
		//{
			//background-size: ".$item->params->get("image_width")."px ".$item->params->get("image_height")."px;
		//}
	  //";
	 // $document->addStyleDeclaration($imagesize);
?>		 
	     

         <div id="borggique" class="borggique">
         </div>
    


        
    
