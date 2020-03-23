<?php
//	if(version_compare(PHP_VERSION,'5.3.0', '<')){
//		echo '当前版本为'.phpversion().'小于5.3.0哦';
//	}else {
//		echo '当前版本为' . PHP_VERSION . '大于5.3.0';
//	}
	require 'sdk/autoload.php';
	
	use \Qiniu\Auth;
	use \Qiniu\Storage\UploadManager;	// 引入上传类
	use \Qiniu\Storage\BucketManager;


	class QiNiuApi
	{
		// 用于签名的公钥和私钥
//		private $accessKey = 'tJZ6tKImv_xfhIJA75AsXWKQVvsU1vTxR6QQUwG0';
//		private $secretKey = 'nFV3A1gRpya4Z1vCZz8lul4dsE7in5boPoDK1pCa';
		private $bucket;  // = 'laojiang';
		private $token_expires = 3600;  // Token 的超时时间。
		protected $auth;

		public function __construct($option) {
			$this->bucket = $option['bucket'];
			// 初始化签权对象
			$this->auth = new Auth($option['accessKey'], $option['secretKey']);
		}

		public function uploadToken() {
			$uploadToken = wp_cache_get('qiniuUploadToken');
			if (!$uploadToken) {
				$uploadToken = $this->auth->uploadToken($this->bucket, null, $this->token_expires);
				wp_cache_set('qiniuUploadToken', $uploadToken);
			}
			return $uploadToken;
		}

		public function Upload($key, $localFilePath) {
			// 构建鉴权对象
			// 生成上传 Token
			$token = $this->uploadToken();

			// 初始化 UploadManager 对象并进行文件的上传。
			$uploadMgr = new UploadManager();
			// 调用 UploadManager 的 putFile 方法进行文件的上传。
			list($ret, $err) = $uploadMgr->putFile($token, $key, $localFilePath);
			if ($err !== null) {
//				var_dump($err);
				return False;
			} else {
//				var_dump($ret);
				return True;
			}
		}

		public function Delete($keys) {
			$config = new \Qiniu\Config();
			$bucketManager = new BucketManager($this->auth, $config);
			//每次最多不能超过1000个
			$ops = $bucketManager->buildBatchDelete($this->bucket, $keys);
			list($ret, $err) = $bucketManager->batch($ops);
			if ($err) {
//				print_r($err);
				return False;
			} else {
//				print_r($ret);
				return True;
			}
		}

		public function hasExist($key) {
			$config = new \Qiniu\Config();
			$bucketManager = new \Qiniu\Storage\BucketManager($this->auth, $config);
			list($fileInfo, $err) = $bucketManager->stat($this->bucket, $key);
			if ($err) {
//				print_r($err);
				return False;
			} else {
//				print_r($fileInfo);
				return True;
			}
		}

	}
