<?php namespace Innodite\Generator;


class TemplatesHelper
{
	public function getTemplate($template, $type = "Common")
	{
		$path = base_path('resources/api-generator-templates/' . $type . '/' . $template . '.txt');
		if(!file_exists($path))
		{
			$path = base_path('vendor/innodite/laravel5-scaffold/src/Innodite/Generator/Templates/' . $type . '/' . $template . '.txt');
		}

		$fileData = file_get_contents($path);

		return $fileData;
	}
}