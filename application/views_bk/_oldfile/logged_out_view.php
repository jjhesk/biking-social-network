
<?


setcookie('fbs_'.$this->facebook->getAppId(), '', time()-100, '/', 'apps.imusictech.com');
session_destroy();
$url = site_url('admin/index/');
echo $url;
//header("Location: {$url}");




?>


You have successfully logged out.
