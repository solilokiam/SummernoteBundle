<?php
/**
 * Created by PhpStorm.
 * User: miquel
 * Date: 01/03/14
 * Time: 22:05
 */

namespace Solilokiam\SummernoteBundle\Controller;


class AssetController
{
    public function uploadAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw $this->createNotFoundException('This method has to be called by ajax');
        }

        $assetManager = $this->get('solilokiam_summernote.asset_manager')

        $file = $request->files->get('summernotefile');

        try {
            $assetManager->handleUpload($file);
        } catch (\Exception $e) {
            $errors = $e->getMessage();

            return new JsonResponse(array('success' => false, 'message' => $errors));
        }

        return new JsonResponse(array('success' => true, 'url' => '/' . $questionAsset->getWebPath()));
    }
} 