<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : App Template Engine
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\Core;

Class Template {

	public $classname 			= 'Template';
	public $debug    			= false;
	public $filename_comments 	= false;
	public $unknown_regexp 		= 'loose';
	public $root     			= '.';
	public $file     			= array();
	public $varkeys  			= array();
	public $varvals  			= array();
	public $unknowns 			= 'keep';
	public $halt_on_error  		= 'yes';
	public $last_error     		= '';


	public function __construct($root = '.', $unknowns = 'keep') {

		if ($this->debug == 4) {
			echo '<p><b>Template:</b> root = ' . $root . ', unknowns = ' . $unknowns . '</p>\n';
		}

		$this->set_root($root);
		$this->set_unknowns($unknowns);
	}

	public function set_root($root) {

		// check if string starts with '/'
		if(strtr($root, 0, strlen($root)) === '/') {
			$root = substr($root, 0, -1);
		}

		if ($this->debug == 4) {
			echo '<p><b>set_root:</b> root = ' . $root . '</p>\n';
		}

		if (!is_dir($root)) {
			$this->halt('set_root: ' . $root . ' is not a directory.');
			return false;
		}

		$this->root = $root;
		return true;
	}

	public function set_unknowns($unknowns = 'remove') {

		if ($this->debug == 4) {
			echo '<p><b>unknowns:</b> unknowns = ' . $unknowns . '</p>\n';
		}

		$this->unknowns = $unknowns;
	}

	public function set_file($varname, $filename = '') {

		if (!is_array($varname)) {

			if ($this->debug == 4) {
				echo '<p><b>set_file:</b> (with scalar) varname = $varname, filename = ' . $filename . '</p>\n';
			}

			//Throw an exception here
			if ($filename == '') {
				$this->halt('set_file: For varname ' . $varname . ' filename is empty.');
				return false;
			}

			$this->file[$varname] = $this->filename($filename);

		}
		else {

			reset($varname);

			while (list($v, $f) = each($varname)) {

				if ($this->debug == 4) {
					echo '<p><b>set_file:</b> (with array) varname = ' . $v . ', filename = ' . $f . '</p>\n';
				}
				if ($f == '') {
					$this->halt('set_file: For varname ' . $v . ' filename is empty.');
					return false;
				}

				$this->file[$v] = $this->filename($f);
			}

		}

		return true;
	}

	public function set_block($parent, $varname, $name = '') {

		if ($this->debug == 4) {
			echo '<p><b>set_block:</b> parent = ' . $parent .' , varname =  ' . $varname . ', name = ' . $name . '</p>\n';
		}

		if (!$this->loadfile($parent)) {
			$this->halt('set_block: unable to load ' . $parent . '.');
			return false;
		}

		if ($name == '') {
			$name = $varname;
		}

		$str = $this->get_var($parent);
		$reg = '/[ \t]*<!--\s+BEGIN ' . $varname . '\s+-->\s*?\n?(\s*.*?\n?)\s*<!--\s+END ' . $varname . '\s+-->\s*?\n?/sm';
		
		preg_match_all($reg, $str, $m);
		
		if (!isset($m[1][0])) {
			$this->halt('set_block: unable to set block ' . $varname . '.');
			return false;
		}
		
		$str = preg_replace($reg, '{' . $name . '}', $str);
		
		$this->set_var($varname, $m[1][0]);
		$this->set_var($parent, $str);
		
		return true;
	}

	public function set_var($varname, $value = '', $append = false) {
    
		if (!is_array($varname)) {
		
			if (!empty($varname)) {
				
				if ($this->debug == 1) {
					printf('<b>set_var:</b> (with scalar) <b>%s</b> = \'%s\'<br>\n', $varname, htmlentities($value));
				}
				
				$this->varkeys[$varname] = '/'.$this->varname($varname).'/';
				
				if ($append && isset($this->varvals[$varname])) {
					$this->varvals[$varname] .= $value;
				} else {
					$this->varvals[$varname] = $value;
				}
			}
		}
		else {
			
			reset($varname);
			
			while (list($k, $v) = each($varname)) {
				
				if (!empty($k)) {
					
					if ($this->debug == 1) {
						printf('<b>set_var:</b> (with array) <b>%s</b> = \'%s\'<br>\n', $k, htmlentities($v));
					}
					
					$this->varkeys[$k] = '/'.$this->varname($k).'/';
				  
					if ($append && isset($this->varvals[$k])) {
						$this->varvals[$k] .= $v;
					} else {
						$this->varvals[$k] = $v;
					}
				}
			}
		}
	}

	public function clear_var($varname) {
		
		if (!is_array($varname)) {
			
			if (!empty($varname)) {
				
				if ($this->debug == 1) {
					printf('<b>clear_var:</b> (with scalar) <b>%s</b><br>\n', $varname);
				}
				
				$this->set_var($varname, '');
			}
		}
		else {
			
			reset($varname);
			
			while (list($k, $v) = each($varname)) {
				
				if (!empty($v)) {
					
					if ($this->debug == 1) {
						printf('<b>clear_var:</b> (with array) <b>%s</b><br>\n', $v);
					}
				  
					$this->set_var($v, '');
				}
			}
		}
	}

	public function unset_var($varname) {
    
		if (!is_array($varname)) {
			
			if (!empty($varname)) {
				
				if ($this->debug == 1) {
					printf('<b>unset_var:</b> (with scalar) <b>%s</b><br>\n', $varname);
				}
				
				unset($this->varkeys[$varname]);
				unset($this->varvals[$varname]);
			}
		}
		else {
			
			reset($varname);
			
			while (list($k, $v) = each($varname)) {
				
				if (!empty($v)) {
					
					if ($this->debug == 1) {
						printf('<b>unset_var:</b> (with array) <b>%s</b><br>\n', $v);
					}
					
					unset($this->varkeys[$v]);
					unset($this->varvals[$v]);
				}
			}
		}
	}

	public function subst($varname) {
		
		$varvals_quoted = array();
    
		if ($this->debug == 4) {
			echo '<p><b>subst:</b> varname = ' . $varname . '</p>\n';
		}
    
		if (!$this->loadfile($varname)) {
			$this->halt('subst: unable to load ' . $varname . '.');
			return false;
		}

		// quote the replacement strings to prevent bogus stripping of special chars
		reset($this->varvals);
		while (list($k, $v) = each($this->varvals)) {
			$varvals_quoted[$k] = preg_replace(array('/\\\\/', '/\$/'), array('\\\\\\\\', '\\\\$'), $v);
		}

		$str = $this->get_var($varname);
		$str = preg_replace($this->varkeys, $varvals_quoted, $str);
		
		return $str;
	}


	public function psubst($varname) {
		
		if ($this->debug == 4) {
			echo '<p><b>psubst:</b> varname = ' . $varname . '</p>\n';
		}
		
		print $this->subst($varname);

		return false;
	}

	public function parse($target, $varname, $append = false) {
		
		if (!is_array($varname)) {
			
			if ($this->debug == 4) {
				echo '<p><b>parse:</b> (with scalar) target = ' . $target . ', varname = ' . $varname . ', append = ' . $append . '</p>\n';
			}
			
			$str = $this->subst($varname);
			
			if ($append) {
				$this->set_var($target, $this->get_var($target) . $str);
			} else {
				$this->set_var($target, $str);
			}
			
		}
		else {
			
			reset($varname);
			
			while (list($i, $v) = each($varname)) {
				
				if ($this->debug == 4) {
				  echo '<p><b>parse:</b> (with array) target = $target, i = ' . $i . ', varname = ' . $v . ', append = ' . $append . '</p>\n';
				}
				
				$str = $this->subst($v);
				
				if ($append) {
					$this->set_var($target, $this->get_var($target) . $str);
				} else {
					$this->set_var($target, $str);
				}
			}
		}

		if ($this->debug == 4) {
			echo '<p><b>parse:</b> completed</p>\n';
		}
		
		return $this->get_var($target);
	}

	public function pparse($target, $varname, $append = false) {
		
		if ($this->debug == 4) {
			echo '<p><b>pparse:</b> passing parameters to parse...</p>\n';
		}
		
		print $this->finish($this->parse($target, $varname, $append));
		
		return false;
	}

	public function get_vars() {
		
		if ($this->debug == 4) {
			echo '<p><b>get_vars:</b> constructing array of vars...</p>\n';
		}
    
		reset($this->varkeys);
    
		while (list($k, $v) = each($this->varkeys)) {
			$result[$k] = $this->get_var($k);
		}
		
		return $result;
	}

	public function get_var($varname) {
    
		if (!is_array($varname)) {
			
			if (isset($this->varvals[$varname])) {
				$str = $this->varvals[$varname];
			} 
			else {
				$str = '';
			}
			
			if ($this->debug == 2) {
				printf ('<b>get_var</b> (with scalar) <b>%s</b> = \'%s\'<br>\n', $varname, htmlentities($str));
			}
			
			return $str;
		} 
		else {
		
			reset($varname);
		
			while (list($k, $v) = each($varname)) {
				
				if (isset($this->varvals[$v])) {
					$str = $this->varvals[$v];
				}
				else {
					$str = '';
				}
				
				if ($this->debug == 2) {
					printf ('<b>get_var:</b> (with array) <b>%s</b> = \'%s\'<br>\n', $v, htmlentities($str));
				}
				
				$result[$v] = $str;
			}
			
			return $result;
		}
	}

	public function get_undefined($varname) {
    
		if ($this->debug == 4) {
			echo '<p><b>get_undefined:</b> varname = ' . $varname . '</p>\n';
		}
    
		if (!$this->loadfile($varname)) {
			$this->halt('get_undefined: unable to load ' . $varname . '.');
			return false;
		}
		
		preg_match_all( (('loose' == $this->unknown_regexp) ? '/{([^ \t\r\n}]+)}/' : '/{([_a-zA-Z]\\w+)}/'), $this->get_var($varname), $m);
    
		$m = $m[1];
		
		if (!is_array($m)) {
			return false;
		}

		reset($m);
		
		while (list($k, $v) = each($m)) {
			
			if (!isset($this->varkeys[$v])) {
				
				if ($this->debug == 4) {
					echo '<p><b>get_undefined:</b> undefined: ' . $v . '</p>\n';
				}
			
				$result[$v] = $v;
			}
		}

		if (count($result)) {
			return $result;
		} else {
			return false;
		}
	}

	public function finish($str) {
		
		switch ($this->unknowns) {
			
			case 'keep':
			break;

			case 'remove':
				$str = preg_replace( (('loose' == $this->unknown_regexp) ? '/{([^ \t\r\n}]+)}/' : '/{([_a-zA-Z]\\w+)}/'), '', $str);
			break;

			case 'comment':
				$str = preg_replace( (('loose' == $this->unknown_regexp) ? '/{([^ \t\r\n}]+)}/' : '/{([_a-zA-Z]\\w+)}/'), '<!-- Template variable \\1 undefined -->', $str);
			break;
		}

		return $str;
	}

	public function p($varname) {
		print $this->finish($this->get_var($varname));
	}

	public function get($varname) {
		return $this->finish($this->get_var($varname));
	}

	public function filename($filename) {
		
		if ($this->debug == 4) {
			echo '<p><b>filename:</b> filename = '. $filename . '</p>\n';
		}
		
		if (
		substr($filename, 0, 1) != '/' 
		&& substr($filename, 0, 1) != '\\' 
		&& substr($filename, 1, 2) != ':\\' 
		&& substr($filename, 1, 2) != ':/' ) {
			$filename = $this->root . '/' . $filename;
		}

		if (!file_exists($filename)) {
			$this->halt('filename: file ' . $filename . ' does not exist.');
		}
		
		return $filename;
	}

	public function varname($varname) {
		return preg_quote('{' . $varname . '}');
	}

	public function loadfile($varname) {
    
		if ($this->debug == 4) {
			echo '<p><b>loadfile:</b> varname = ' . $varname . '</p>\n';
		}

		if (!isset($this->file[$varname])) {
			
			// $varname does not reference a file so return
			if ($this->debug == 4) {
				echo '<p><b>loadfile:</b> varname ' . $varname . 'does not reference a file</p>\n';
			}
		
			return true;
		}

		if (isset($this->varvals[$varname])) {
		
			// will only be unset if varname was created with set_file and has never been loaded
			// $varname has already been loaded so return
			if ($this->debug == 4) {
				echo '<p><b>loadfile:</b> varname ' . $varname . ' is already loaded</p>\n';
			}
			
			return true;
		}
    
		$filename = $this->file[$varname];

		/* use @file here to avoid leaking filesystem information if there is an error */
		$str = implode('', @file($filename));
		if (empty($str)) {
			$this->halt('loadfile: While loading ' . $varname . ', ' . $filename . ' does not exist or is empty.');
			return false;
		}

		if ($this->filename_comments) {
			$str = '<!-- START FILE ' . $filename . ' -->\n' . $str . '<!-- END FILE ' . $filename . ' -->\n';
		}
		
		if ($this->debug == 4) {
			printf('<b>loadfile:</b> loaded ' . $filename . ' into ' . $varname . '<br>\n');
		}
		
		$this->set_var($varname, $str);

		return true;
	}

	public function halt($msg) {
		
		$this->last_error = $msg;

		if ($this->halt_on_error != 'no') {
			$this->haltmsg($msg);
		}

		if ($this->halt_on_error == 'yes') {
			die('<b>Halted.</b>');
		}

		return false;
	}

	public function haltmsg($msg) {
		printf('<b>Template Error:</b> %s<br>\n', $msg);
	}

}

?>
