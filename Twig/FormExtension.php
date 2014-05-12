<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 10/04/14
 * Time: 21:15
 */

namespace Solilokiam\SummernoteBundle\Twig;


use Symfony\Bridge\Twig\Form\TwigRendererInterface;
use Symfony\Component\Form\FormView;

class FormExtension extends \Twig_Extension
{
    public $renderer;
    public $widgetConfig;

    function __construct(TwigRendererInterface $renderer, $widgetConfig)
    {
        $this->renderer = $renderer;
        $this->widgetConfig = $widgetConfig;
    }

    public function getFunctions()
    {
        return array(
            'form_javascript' => new \Twig_Function_Method($this, 'renderJavascript', array('is_safe' => array('html'))),
            'form_stylesheet' => new \Twig_Function_Method($this, 'renderStylesheet', array('is_safe' => array('html'))),
        );
    }

    public function renderJavascript(FormView $view)
    {
        return $this->renderer->searchAndRenderBlock($view, 'javascript');
    }

    public function renderStylesheet(FormView $view)
    {
        return $this->renderer->searchAndRenderBlock($view, 'stylesheet');
    }

    public function getGlobals()
    {
        return array(
            'solilokiam_summernote_config' => "{
                                                    height: " . $widgetConfig['height'] . ",
                                                    focus: " . $widgetConfig['focus'] . ",
                                                    toolbar: " . json_encode($widgetConfig['toolbar']) . ",
                                                    onImageUpload: function (files, editor, welEditable) {
                                                        sendFile(files[0], editor, welEditable);
                                                    }
                                                }"
        );
    }


    public function getName()
    {
        return 'solilokiamsummernotebundle.twig.extension.form';
    }

} 