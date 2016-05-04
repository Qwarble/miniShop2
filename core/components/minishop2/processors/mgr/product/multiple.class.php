<?php

class msProductMultipleProcessor extends modProcessor
{


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$method = $this->getProperty('method', false)) {
            return $this->failure();
        }
        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->success();
        }

        /** @var miniShop2 $miniShop2 */
        $miniShop2 = $this->modx->getService('miniShop2');

        foreach ($ids as $id) {
            /** @var modProcessorResponse $response */
            $response = $miniShop2->runProcessor('mgr/product/' . $method, array('id' => $id));
            if ($response->isError()) {
                return $response->getResponse();
            }
        }

        return $this->success();
    }

}

return 'msProductMultipleProcessor';