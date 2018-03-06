<?php

namespace Qcloud\Cos\Tests;

require('/../../../include.php');

use QCloud\Cos\Api;

class Test extends \PHPUnit_Framework_TestCase {
    private $cosClient;
    private $cosApi;
    private $bucket;
    private $cospath;
    private $localpath;
    protected function setUp() {
        $config = array(
            'app_id' => '1252448703',
            'secret_id' => getenv('COS_KEY'),
            'secret_key' => getenv('COS_SECRET'),
            'region' => getenv('COS_REGION'),   // bucket所属地域：华北 'tj' 华东 'sh' 华南 'gz'
            'timeout' => 60
        );
        $this->cosApi = new Api($config);
        $this->bucket = 'testbucketv4'. getsenv('COS_REGION');
        $this->cospath = '→↓←→↖↗↙↘! \"#$%&\'()*+,-./0123456789:;<=>@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
        $this->localpath = "111";
        $this->folder = "新建folder";

        $file = $this->localpath;
        file_put_contents($file,"12345",FILE_APPEND);
    }


    protected function tearDown() {
        unlink ($this->localpath);
    }

    public function testUploadFile() {
        try {
            $rt = $this->cosApi->upload($this->bucket, $this->localpath, $this->cospath);
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }
    public function testStatFile() {
        try {
            $file = $this->localpath;
            file_put_contents($file,"12345",FILE_APPEND);
            $this->cosApi->upload($this->bucket, $this->localpath, $this->cospath);
            $rt = $this->cosApi->stat($this->bucket, $this->cospath);
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }
    public function testDownloadFile() {
        try {
            $this->cosApi->upload($this->bucket, $this->localpath, $this->cospath);
            $rt = $this->cosApi->download($this->bucket, $this->cospath, $this->localpath);
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }
    public function testUpdateFileInfo() {
        try {
            $this->cosApi->upload($this->bucket, $this->localpath, $this->cospath);
            $bizAttr = '';
            $authority = 'eWPrivateRPublic';
            $customerHeaders = array(
                'Cache-Control' => 'no',
                'Content-Type' => 'application/pdf',
                'Content-Language' => 'ch',
            );
            $rt = $this->cosApi->update($this->bucket, $this->cospath, $bizAttr, $authority, $customerHeaders);
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }
    public function testCopyFile() {
        try {
            $this->cosApi->upload($this->bucket, $this->localpath, $this->cospath);
            $rt = $this->cosApi->copyFile($this->bucket, $this->cospath, $this->cospath . '_copy');
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }
    public function testMoveFile() {
        try {
            $this->cosApi->upload($this->bucket, $this->localpath, $this->cospath);
            $rt = $this->cosApi->moveFile($this->bucket, $this->cospath, $this->cospath . '_move');
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }
    public function testDeleteFile() {
        try {
            $this->cosApi->upload($this->bucket, $this->localpath, $this->cospath);
            $rt = $this->cosApi->delFile($this->bucket, $this->cospath);
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }
    public function testCreateFolder() {
        try {
            $rt = $this->cosApi->createFolder($this->bucket, $this->folder);;
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }

    public function testListFolder() {
        try {
            $this->cosApi->createFolder($this->bucket, $this->folder);
            $rt = $this->cosApi->listFolder($this->bucket, $this->folder);
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }

    public function testUpdateFolderInfo() {
        try {
            $bizAttr = "";
            $this->cosApi->createFolder($this->bucket, $this->folder);
            $rt = $this->cosApi->updateFolder($this->bucket, $this->folder, $bizAttr);
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }
    public function testStatFolder() {
        try {
            $this->cosApi->createFolder($this->bucket, $this->folder);
            $rt = $this->cosApi->statFolder($this->bucket, $this->folder);
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }
    public function testDelteFolder() {
        try {
            $this->cosApi->createFolder($this->bucket, $this->folder);
            $rt = $this->cosApi->delFolder($this->bucket, $this->folder);
            
            $this->assertFalse(false, $rt['code']);
        } catch (\Exception $e) {
            $this->assertFalse(true, $e);
        }
    }
}
