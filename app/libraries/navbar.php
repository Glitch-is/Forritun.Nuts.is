<?php

class Navbar{
	public static function render($data){
		$output = "";
		foreach ($data as $k => $v){
			$output .= '<li ';
			if (is_array($v)){
				$output .= 'class="';
				if (in_array(substr(URL::current(),strlen(Request::root())),$v))
					$output .= 'active ';
				$output .= 'dropdown">';
				$output .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
				$output .= $k;
				$output .= '<b class="caret"></b></a>';
				$output .= '<ul class="dropdown-menu">';
				foreach ($v as $key => $link){
					$output .= '<li>';
					$output .= '<a href="' . $link . '">' . $key . '</a>';
					$output .= '</li>';
				}
				$output .= '</ul>';
			}
			else
			{
				if (substr(URL::current(),strlen(Request::root())) === $v) 
					$output .= 'class="active"';
				$output .= '><a href="' . $v . '">' . $k . '</a>';
			}
			$output .= '</li>';
		}
		return $output;
	}
}