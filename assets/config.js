var config_values = {
	'browser_sync_port': 3000,
   'browser_sync_proxy': 'localhost/workspaceWordpress/_7devlab/hotevia.info/',
    
	//'ftp_remote_location_test': '/public_html/demos/demo/wp-content/themes/7devlab-exploor',
	'ftp_remote_location_test': '/domains/7devlab.com/public_html/demos/exploorperu.com/wp-content/themes/7devlab-exploor',
	'ftp_host_test': '89.117.139.189',
	'ftp_username_test': "u229619509",
	'ftp_password_test': "7-8-9Contra@",

	'ftp_remote_location': '/public_html/wp-content/themes/7devlab-exploor',
	'ftp_host': 'ftp.exploorperu.com',
	'ftp_username': "exploorperu@exploorperu.com",
	'ftp_password': "Boiler789$ - nopass",
	'ftp_paths': [
		'./favicon/**',
		'./functions/**',
		'./inc/**',
		'./parts/**',
		'./public/**',
		//'./static_scripts/**',
		'./woocommerce/**',
		'./*.php',
		'./*.ico',
		'./*.css'
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
















