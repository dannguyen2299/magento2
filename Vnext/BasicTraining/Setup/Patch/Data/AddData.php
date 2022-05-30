<?php

namespace Vnext\BasicTraining\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddData implements DataPatchInterface
{
    private $postFactory;

    public function __construct(
        \Vnext\BasicTraining\Model\PostFactory $postFactory
    ) {
        $this->postFactory = $postFactory;
    }

    public function apply()
    {
        $sampleData = [
            [
                'name' => 'Nguyen Thi My Hanh',
                'gender' => '0',
                'dob' => '1999-4-12',
                'address'=>'Thai Binh'
            ],
            [
                'name' => 'Nguyen Viet Hai',
                'gender' => '1',
                'dob' => '1998-8-12',
                'address'=>'Thai Binh'
            ]
        ];
        foreach ($sampleData as $data) {
            $this->postFactory->create()->setData($data)->save();
        }
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

}
