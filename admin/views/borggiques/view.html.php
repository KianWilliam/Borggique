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
defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.application.component.view');
class BorggiqueViewBorggiques extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;
	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->addToolbar();		
		parent::display($tpl);		
	}
	protected function addToolbar()
	{
		$title = JText::_('COM_BORGGIQUE'). " - ". JText::_('COM_BORGGIQUE_BORGGIQUES');
		JToolBarHelper::title($title , 'generic.png');
		
		JToolBarHelper::addNew('borggique.add','JTOOLBAR_NEW');
		JToolBarHelper::editList('borggique.edit','JTOOLBAR_EDIT');
		JToolBarHelper::deleteList('COM_BORGGIQUE_BORGGIQUES_APPROVE_DELETE', 'borggiques.delete','JTOOLBAR_DELETE');
		JToolBarHelper::divider();
		JToolBarHelper::custom('borggiques.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
		JToolBarHelper::custom('borggiques.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);

	}



}