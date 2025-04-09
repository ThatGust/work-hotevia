var config_values = {
	'browser_sync_port': 3000,
   'browser_sync_proxy': 'localhost/workspaceWordpress/_7devlab/hotevia.info/',
    
	//'ftp_remote_location_test': '/public_html/demos/demo/wp-content/themes/7devlab-exploor',
	'ftp_remote_location_test': '/domains/7devlab.com/public_html/demos/hotevia.info/wp-content/themes/newsplus',
	'ftp_host_test': '46.202.196.239',
	'ftp_username_test': "u229619509",
	'ftp_password_test': "7-8-9Contra@",

	'ftp_remote_location': '/public_html/wp-content/themes/7devlab-exploor',
	'ftp_host': 'ftp.exploorperu.com',
	'ftp_username': "exploorperu@exploorperu.com",
	'ftp_password': "Boiler789$ - nopass",
	'ftp_paths': [
		'./css/**',
      './functions/**',
      './js/**',
		'./*.php',
	],
	'ftp_port': 21,
	'sftp_port': 22,
}
exports.getConfigValues = function() {
	return config_values;
};


exports.getMainJsJQuery = function() {
	return [
		'./assets/js/main.js',
	]
};
















