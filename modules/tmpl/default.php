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
  $document = JFactory::getDocument();
  $document->addStyleSheet(JURI::Base()."components/com_borggique/assets/css/borggique.css");
  $class = $params->get("moduleclass");
  
  $attr = "
	jQuery(document).ready(function(){
		jQuery('#mborggique').attr('class', '".$class."');
	});
  ";
 // $document->addScriptDeclaration($attr);
  $row = "";		
  JPluginHelper::importPlugin('content');
  $dispatcher = JEventDispatcher::getInstance();
  $dispatcher->trigger('onContentPrepare', array('mod_borggique', &$row, &$params, 0 ) );
				 
	

?>

         <div  id="mborggique" class="<?php echo $class; ?>" >
         </div>
