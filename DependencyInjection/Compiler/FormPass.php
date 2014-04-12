<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 10/04/14
 * Time: 21:44
 */

namespace Solilokiam\SummernoteBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FormPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $resources = $container->getParameter('twig.form.resources');

        foreach (array('field', 'javascript', 'stylesheet') as $template) {
            $resources[] = 'SolilokiamSummernoteBundle:Form:summernote' . $template . '.html.twig';
        }

        $container->setParameter('twig.form.resources', $resources);
    }

} 