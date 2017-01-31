<?php
class AitGetDirectionsElement extends AitElement
{
	public function getPaths()
	{
		if(!$this->paths){
			$this->paths = new stdClass;
			$this->paths->url = (object) array(
				'root'      => AitGetDirections::getPluginUrl('/elements/get-directions'),
				'css'       => AitGetDirections::getPluginUrl('/elements/get-directions/design/css'),
				'js'        => AitGetDirections::getPluginUrl('/elements/get-directions/design/js'),
				'img'       => AitGetDirections::getPluginUrl('/elements/get-directions/design/img'),
			);
			$this->paths->dir = (object) array(
				'root'      => dirname(__FILE__),
				'css'       => dirname(__FILE__). "/design/css",
				'js'        => dirname(__FILE__). "/design/js",
				'img'       => dirname(__FILE__). "/design/img",
			);
		}

		return $this->paths;
	}

	public function getTemplate()
	{
		if(is_null($this->template)){
			$this->template =  dirname(__FILE__) . "/{$this->templateName}";
		}
		return $this->template;
	}

	public function getBaseStyleUrl()
	{
		return AitGetDirections::getPluginUrl('/elements/get-directions/design/css/base-style.css');
	}

	public function getStyleLessFile()
	{
		return dirname(__FILE__) . "/design/css/style.less";
	}



	public function createLessCompiler()
	{
		$less = AitLessCompiler::create(
			aitGetPaths('elements', '', 'path', true),
			aitGetPaths('elements', '', 'url', true)
		);

		$less->importDir[] = $this->getPaths()->dir->css;
		$less->importUrl[] = $this->getPaths()->url->css;

		return $less;
	}
}