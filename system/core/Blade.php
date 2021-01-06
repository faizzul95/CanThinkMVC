<?php 

 class Blade
  {
        var $template_data = array();

        public function set($name, $value)
        {
            $this->template_data[$name] = $value;
        }

        public function load($template = '', $view = '', $view_data = array(), $return = FALSE)
        {
            $this->CI =& get_instance();
            $this->set('contents', $this->view($view, $view_data,TRUE));
            return $this->view($template, $this->template_data, $return);
        }

    
  }
