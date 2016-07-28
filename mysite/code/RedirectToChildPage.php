<?php
/**
 * Page that redericts to its first child
 */
class RedirectToChildPage extends Page {
    private static $description = 'Redirects to the first child-page (that is displayed in the menu)';
    // don't add links to itself in the html-source, always use the child
    function Link() {
        return $this->Children()->First() ? $this->Children()->First()->Link() : parent::Link();
    }

    // hide Content entry box
    function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('Content', true);
        return $fields;
    }

    function ContentSource() {
        if($this->Children()->First()) {
            return $this->Children()->First();
        } else {
            return $this;
        }      
    }
}

class RedirectToChildPage_Controller extends Page_Controller {
    function init() {
        parent::init();
        if($this->Children()->First()) {
            $this->redirect($this->Children()->First()->Link());
        }
    }
}
