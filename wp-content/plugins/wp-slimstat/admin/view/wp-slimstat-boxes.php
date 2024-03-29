<?php

class wp_slimstat_boxes{
	public static $filters_string = '';

	// Variables used to generate the HTML code for the metaboxes
	public static $current_screen = '';
	public static $current_screen_url = '';
	public static $ip_lookup_url = '';
	public static $plugin_url = '';
	public static $home_url = '';
	public static $meta_box_order_nonce = '';

	// Tab panels drag-and-drop functionality
	public static $all_boxes_titles = array();
	public static $all_boxes = '';
	public static $hidden_boxes = '';
	
	// Shared descriptions
	public static $chart_tooltip = '';

	/**
	 * Initalizes class properties
	 */
	public static function init(){
		self::$current_screen = empty($_GET['slimpanel'])?1:intval($_GET['slimpanel']);
		self::$current_screen_url = wp_slimstat_admin::$admin_url.self::$current_screen;
		self::$ip_lookup_url = !empty(wp_slimstat::$options['ip_lookup_service'])?wp_slimstat::$options['ip_lookup_service']:'http://www.maxmind.com/app/lookup_city?ips=';
		self::$plugin_url = plugins_url('', dirname(__FILE__));
		self::$home_url = home_url();
		self::$meta_box_order_nonce = wp_create_nonce('meta-box-order');

		// Retrieve the order of this tab's panels and which ones are hidden
		$user = wp_get_current_user();
		$page_location = (wp_slimstat::$options['use_separate_menu'] == 'yes')?'toplevel':'dashboard';

		// Load localization files
		load_plugin_textdomain('wp-slimstat-view', WP_PLUGIN_DIR .'/wp-slimstat/admin/lang', '/wp-slimstat/admin/lang');
		load_plugin_textdomain('countries-languages', WP_PLUGIN_DIR .'/wp-slimstat/admin/lang', '/wp-slimstat/admin/lang');
		
		// If a local translation for countries and languages does not exist, use English
		if (!isset($l10n['countries-languages'])){
			load_textdomain('countries-languages', WP_PLUGIN_DIR .'/wp-slimstat/admin/lang/countries-languages-en_US.mo');
		}

		self::$all_boxes_titles = array(
			'slim_p1_01' => __('Pageviews (chart)','wp-slimstat-view'),
			'slim_p1_02' => __('About WP SlimStat','wp-slimstat-view'),
			'slim_p1_03' => __('Summary','wp-slimstat-view'),
			'slim_p1_04' => __('Recent Known Visitors','wp-slimstat-view'),
			'slim_p1_05' => __('Spy View','wp-slimstat-view'),
			'slim_p1_06' => __('Recent Search Terms','wp-slimstat-view'),
			'slim_p1_07' => __('Top Languages - Just Visitors','wp-slimstat-view'),
			'slim_p1_08' => __('Top Pages','wp-slimstat-view'),
			'slim_p1_09' => __('Recent Countries','wp-slimstat-view'),
			'slim_p1_10' => __('Top Traffic Sources','wp-slimstat-view'),
			'slim_p1_11' => __('Top Known Visitors','wp-slimstat-view'),
			'slim_p1_12' => __('Top Search Terms','wp-slimstat-view'),
			'slim_p1_13' => __('Top Countries','wp-slimstat-view'),
			'slim_p2_01' => __('Human Visits (chart)','wp-slimstat-view'),
			'slim_p2_02' => __('Summary','wp-slimstat-view'),
			'slim_p2_03' => __('Top Languages','wp-slimstat-view'),
			'slim_p2_04' => __('Top User Agents','wp-slimstat-view'),
			'slim_p2_05' => __('Top Service Providers','wp-slimstat-view'),
			'slim_p2_06' => __('Top Operating Systems','wp-slimstat-view'),
			'slim_p2_07' => __('Top Screen Resolutions','wp-slimstat-view'),
			'slim_p2_09' => __('Browser Capabilities','wp-slimstat-view'),
			'slim_p2_10' => __('Top Countries','wp-slimstat-view'),
			'slim_p2_12' => __('Visit Duration','wp-slimstat-view'),
			'slim_p2_13' => __('Recent Countries','wp-slimstat-view'),
			'slim_p2_14' => __('Recent Screen Resolutions','wp-slimstat-view'),
			'slim_p2_15' => __('Recent Operating Systems','wp-slimstat-view'),
			'slim_p2_16' => __('Recent User Agents','wp-slimstat-view'),
			'slim_p2_17' => __('Recent Languages','wp-slimstat-view'),
			'slim_p3_01' => __('Traffic Sources (chart)','wp-slimstat-view'),
			'slim_p3_02' => __('Summary','wp-slimstat-view'),
			'slim_p3_03' => __('Top Search Terms','wp-slimstat-view'),
			'slim_p3_04' => __('Top Countries','wp-slimstat-view'),
			'slim_p3_05' => __('Top Traffic Sources','wp-slimstat-view'),
			'slim_p3_06' => __('Top Referring Search Engines','wp-slimstat-view'),
			'slim_p3_08' => __('Spy View','wp-slimstat-view'),
			'slim_p3_09' => __('Recent Search Terms','wp-slimstat-view'),
			'slim_p3_10' => __('Recent Countries','wp-slimstat-view'),
			'slim_p3_11' => __('Top Landing Pages','wp-slimstat-view'),
			'slim_p4_01' => __('Average Pageviews per Visit (chart)','wp-slimstat-view'),
			'slim_p4_02' => __('Recent Posts','wp-slimstat-view'),
			'slim_p4_03' => __('Recent Bounce Pages','wp-slimstat-view'),
			'slim_p4_04' => __('Recent Feeds','wp-slimstat-view'),
			'slim_p4_05' => __('Recent 404 URLs','wp-slimstat-view'),
			'slim_p4_06' => __('Recent Internal Searches','wp-slimstat-view'),
			'slim_p4_07' => __('Top Categories','wp-slimstat-view'),
			'slim_p4_08' => __('Recent Outbound Links','wp-slimstat-view'),
			'slim_p4_10' => __('Recent Events','wp-slimstat-view'),
			'slim_p4_11' => __('Top Posts','wp-slimstat-view'),
			'slim_p4_12' => __('Top Feeds','wp-slimstat-view'),
			'slim_p4_13' => __('Top Internal Searches','wp-slimstat-view'),
			'slim_p4_14' => __('Top Search Terms','wp-slimstat-view'),
			'slim_p4_15' => __('Recent Categories','wp-slimstat-view'),
			'slim_p4_16' => __('Top 404 URLs','wp-slimstat-view'),
			'slim_p4_17' => __('Top Landing Pages','wp-slimstat-view'),
			'slim_p4_18' => __('Top Authors','wp-slimstat-view')
		);

		if (self::$current_screen != 1){
			self::$all_boxes = get_user_option("meta-box-order_{$page_location}_page_wp-slimstat-".self::$current_screen, $user->ID);
			self::$all_boxes = (self::$all_boxes === false)?get_user_option("meta-box-order_{$page_location}_page_wp-slimstat", $user->ID):self::$all_boxes; // backward compatible with old settings
		}
		self::$all_boxes = (empty(self::$all_boxes))?array():explode(',', self::$all_boxes[0]);

		// Use default values, if the corresponding option hasn't been initialized
		$old_ids = array_intersect(array('p1_01','p2_01','p3_01','p4_01'), self::$all_boxes);
		if (empty(self::$all_boxes) || !empty($old_ids)){
			switch(self::$current_screen){
				case 2:
					self::$all_boxes = array('slim_p1_01','slim_p1_02','slim_p1_03','slim_p1_04','slim_p1_05','slim_p1_06','slim_p1_07','slim_p1_08','slim_p1_09','slim_p1_10','slim_p1_11','slim_p1_12','slim_p1_13');
					break;
				case 3:
					self::$all_boxes = array('slim_p2_01','slim_p2_02','slim_p2_03','slim_p2_04','slim_p2_05','slim_p2_06','slim_p2_07','slim_p2_09','slim_p2_10','slim_p2_12','slim_p2_13','slim_p2_14','slim_p2_15','slim_p2_16','slim_p2_17');
					break;
				case 4:
					self::$all_boxes = array('slim_p4_01','slim_p4_07','slim_p4_02','slim_p4_03','slim_p4_05','slim_p4_04','slim_p4_06','slim_p4_08','slim_p4_12','slim_p4_13','slim_p4_14','slim_p4_15','slim_p4_16','slim_p4_17','slim_p4_18','slim_p4_11','slim_p4_10');
					break;
				case 5:
					self::$all_boxes = array('slim_p3_01','slim_p3_02','slim_p3_03','slim_p3_04','slim_p3_06','slim_p3_05','slim_p3_08','slim_p3_10','slim_p3_9','slim_p3_11');
					break;
				default:
			}
		}

		// Some boxes are hidden by default
		if (!empty($_GET['page']) && $_GET['page'] == 'wp-slimstat')
			self::$hidden_boxes = get_user_option("metaboxhidden_{$page_location}_page_wp-slimstat-".self::$current_screen, $user->ID);
		else // the script is being called from the dashboard widgets plugin
			self::$hidden_boxes = get_user_option("metaboxhidden_{$page_location}", $user->ID);
		
		self::$hidden_boxes = (self::$hidden_boxes === false)?array():self::$hidden_boxes;
		
		// Default values
		$old_ids = array_intersect(array('p1_01','p2_01','p3_01','p4_01'), self::$hidden_boxes);
		if (self::$hidden_boxes === false || !empty($old_ids)){
			switch(self::$current_screen){
				case 2:
					self::$hidden_boxes = array('slim_p1_11', 'slim_p1_12', 'slim_p1_13');
					break;
				case 3:
					self::$hidden_boxes= array('slim_p2_13', 'slim_p2_14', 'slim_p2_15', 'slim_p2_16', 'slim_p2_17');
					break;
				case 4:
					self::$hidden_boxes = array('slim_p4_11', 'slim_p4_12', 'slim_p4_13', 'slim_p4_14', 'slim_p4_15', 'slim_p4_16', 'slim_p4_17');
					break;
				case 5:
					self::$hidden_boxes = array('slim_p3_09', 'slim_p3_10');
					break;
				default:
					self::$hidden_boxes = array();
			}
		}

		// Filters use the following format: browser equals Firefox|country contains gb
		if (!empty($_REQUEST['fs'])) self::$filters_string .= urlencode($_REQUEST['fs']);
		if (!empty($_POST['f']) && !empty($_POST['o'])) self::$filters_string = self::replace_query_arg($_POST['f'], !isset($_POST['v'])?'':$_POST['v'], $_POST['o']);

		if (!empty($_POST['day'])) self::$filters_string = self::replace_query_arg('day', $_POST['day'], 'equals');
		if (!empty($_POST['month'])) self::$filters_string = self::replace_query_arg('month', $_POST['month'], 'equals');
		if (!empty($_POST['year'])) self::$filters_string = self::replace_query_arg('year', $_POST['year'], 'equals');
		if (!empty($_POST['interval'])) self::$filters_string = self::replace_query_arg('interval', $_POST['interval'], 'equals');
		
		// The 'starting' filter only applies to the 'Right Now' screen
		if (self::$current_screen != 1) self::$filters_string = self::replace_query_arg('starting');
		
		// Import and initialize the API to interact with the database
		include_once(WP_PLUGIN_DIR."/wp-slimstat/admin/view/wp-slimstat-db.php");
		wp_slimstat_db::init(self::$filters_string);
		
		// Default text for the inline help associated to the chart
		self::$chart_tooltip = '<strong>'.htmlspecialchars(__('Chart controls','wp-slimstat-view'), ENT_QUOTES).'</strong><ul><li>'.htmlspecialchars(__('Use your mouse wheel to zoom in and out','wp-slimstat-view'), ENT_QUOTES).'</li><li>'.htmlspecialchars(__('While zooming in, drag the chart to move to a different area','wp-slimstat-view'), ENT_QUOTES).'</li><li>'.htmlspecialchars(__('Double click on an empty region to reset the zoom level','wp-slimstat-view'), ENT_QUOTES).'</li>';
		self::$chart_tooltip .= (!wp_slimstat_db::$day_filter_active)?'<li>'.htmlspecialchars(__('Click on a data point to display the activity chart for each hour of that day','wp-slimstat-view'), ENT_QUOTES).'</li>':'';
	}
	// end init

	/**
	 * Replaces values in a given query string; if key is not found, it's added; if value is empty, key will be removed
	 */
	public static function replace_query_arg($_keys = array('id'), $_values = array(''), $_operators = array('equals')){
		if (!is_array($_keys)) $_keys = array($_keys);
		if (!is_array($_values)) $_values = array($_values);
		if (!is_array($_operators)) $_operators = array($_operators);
		
		$new_filters_string = urldecode(self::$filters_string);
		
		foreach ($_keys as $idx => $a_key){
			if ($_values[$idx]!== '0' && empty($_values[$idx]) && $_operators[$idx] != 'is_empty' && $_operators[$idx] != 'is_not_empty')
				$new_filters_string = preg_replace("/([^_]?)$a_key [^\|]+\|/i", '$1', $new_filters_string, -1, $count);
			else{
				$_operators[$idx] = empty($_operators[$idx])?'equals':$_operators[$idx];
				$new_filters_string = preg_replace("/([^_]?)$a_key [^\|]+\|/i", '$1', $new_filters_string)."$a_key {$_operators[$idx]} {$_values[$idx]}|";
			}
		}
		return urlencode($new_filters_string);
	}
	// end replace_query_arg

	public static function fs_url($_keys = array('none'), $_values = array(''), $_operators = array('equals')){
		if ($_keys == array('none'))
			return self::$current_screen_url.(!empty(self::$filters_string)?'&amp;fs='.self::$filters_string:'');
		else
			return self::$current_screen_url.'&amp;fs='.self::replace_query_arg($_keys, $_values, $_operators);
	}

	/**
	 * Generate the HTML that lists all the filters currently used
	 */
	public static function get_filters_html($_filters_array = array()){
		$filters_html = '';
		
		// Don't display direction and limit results
		$filters_dropdown = array_diff_key($_filters_array, array('direction' => 'asc', 'limit_results' => 20, 'starting' => 0));

		if (!empty($filters_dropdown)){
			$filters_html = "<span class='filters-title'>";
			if(count($filters_dropdown) > 1){
				$filters_html .= "<a class='remove-filter' title='".__('Remove all filters','wp-slimstat-view')."' style='margin-right:5px' href='".self::$current_screen_url."'></a>";
			}
			$filters_html .= __('Current filters:','wp-slimstat-view').'</span> ';
			foreach($filters_dropdown as $a_filter_label => $a_filter_details){
				$a_filter_value_no_slashes = str_replace('\\','', $a_filter_details[1]);
				$filters_html .= "<span class='filter-item'><a class='remove-filter' title='".htmlspecialchars(__('Remove filter for','wp-slimstat-view'), ENT_QUOTES).' '.$a_filter_label."' href='".self::fs_url($a_filter_label)."'></a> <code>".htmlspecialchars("$a_filter_label ".str_replace('_', ' ', $a_filter_details[0])." $a_filter_value_no_slashes")."</code> </span> ";
			}
		}
		else{
			$filters_html = '<h3>'.ucfirst(date_i18n('F Y')).'</h3>  ';
		}
		
		return $filters_html;
	}

	public static function box_header($_id = 'p0', $_tooltip = '', $_postbox_class = '', $_more = false, $_inside_class = '', $_title = ''){
		echo "<div class='postbox $_postbox_class' id='$_id'".(in_array($_id, self::$hidden_boxes)?' style="display:none"':'').'>';
		if (!empty($_tooltip)) echo "<span class='box-help' title='$_tooltip'></span>";
		//if ($_more) echo '<a class="more" href="javascript:;"></a>';
		echo "<h3 class='hndle'>".(!empty($_title)?$_title:self::$all_boxes_titles[$_id])."</h3><div class='inside $_inside_class'>";
	}

	public static function box_footer(){
		echo '</div></div>';
	}
	
	public static function inline_help($_text = ''){
		echo "<span class='inline-help' title='$_text'></span>";
	}

	public static function show_results($_type = 'recent', $_id = 'p0', $_column = 'id', $_args = array()){
		if ($_id != 'p0' && in_array($_id, self::$hidden_boxes)) return;
		
		// Initialize default values, if not specified
		$_args = array_merge(array('custom_where' => '', 'more_columns' => '', 'join_tables' => '', 'having_clause' => '', 'order_by' => '', 'total_for_percentage' => 0), $_args);

		switch($_type){
			case 'recent':
				$results = wp_slimstat_db::get_recent(wp_slimstat_db::get_table_identifier($_column).$_column, $_args['custom_where'], $_args['join_tables'], $_args['having_clause'], $_args['order_by']);
				break;
			case 'popular':
				$results = wp_slimstat_db::get_popular(wp_slimstat_db::get_table_identifier($_column).$_column, $_args['custom_where'], $_args['more_columns'], $_args['having_clause']);
				break;
			case 'popular_complete':
				$results = wp_slimstat_db::get_popular_complete(wp_slimstat_db::get_table_identifier($_column).$_column, $_args['custom_where'], $_args['join_tables'], $_args['having_clause']);
				break;
			default:
		}

		if (count($results) == 0) echo '<p class="nodata">'.__('No data to display','wp-slimstat-view').'</p>';

		for($i=0;$i<count($results);$i++){
			$element_title = $percentage = '';
			$element_value = $results[$i][$_column];

			// Convert the IP address
			if (!empty($results[$i]['ip'])) $results[$i]['ip'] = long2ip($results[$i]['ip']);

			// Some columns require a special pre-treatment
			switch ($_column){
				case 'browser':
					$element_value = $results[$i]['browser'].(!empty($results[$i]['version'])?' '.$results[$i]['version']:'');
					break;
				case 'category':
					$element_title .= '<br>'.__('Category ID','wp-slimstat-view').": {$results[$i]['category']}";
					$cat_ids = explode(',', $results[$i]['category']);
					if (!empty($cat_ids)){
						$element_value = '';
						foreach ($cat_ids as $a_cat_id){
							$cat_name = get_cat_name($a_cat_id);
							$element_value .= ', '.(!empty($cat_name)?$cat_name:$a_cat_id);
						}
						$element_value = substr($element_value, 2);
					}
					break;
				case 'country':
					$element_title .= '<br>'.__('Country Code','wp-slimstat-view').": {$results[$i]['country']}";
					$element_value = __('c-'.$results[$i]['country'], 'countries-languages');
					break;
				case 'ip':
					if (wp_slimstat::$options['convert_ip_addresses'] == 'yes'){
						$element_value = gethostbyaddr($results[$i]['ip']);
					}
					else{
						$element_value = $results[$i]['ip'];
					}
					break;
				case 'language':
					$element_title = '<br>'.__('Language Code','wp-slimstat-view').": {$results[$i]['language']}";
					$element_value = __('l-'.$results[$i]['language'], 'countries-languages');
					break;
				case 'platform':
					$element_title = '<br>'.__('OS Code','wp-slimstat-view').": {$results[$i]['platform']}";
					$element_value = __($results[$i]['platform'], 'countries-languages');
					break;
				case 'resource':
					$post_id = url_to_postid(strtok($results[$i]['resource'], '?'));
					if ($post_id > 0){
						$element_title = "<br>{$results[$i]['resource']}";
						$element_value = get_the_title($post_id);
					}
					break;
				default:
			}

			$element_value = "<a title=\"".sprintf(__('Filter results where %s equals %s','wp-slimstat-view'), $_column, htmlspecialchars($results[$i][$_column], ENT_QUOTES))."\" href='".self::fs_url($_column, $results[$i][$_column])."'>$element_value</a>";

			if ($_type == 'recent'){
				$element_title = date_i18n(wp_slimstat_db::$date_time_format, $results[$i]['dt']).$element_title;
			}
			else{
				$percentage = '<span>'.(($_args['total_for_percentage'] > 0)?number_format(sprintf("%01.2f", (100*$results[$i]['count']/$_args['total_for_percentage'])), 2, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator):0).'%</span>';
				$element_title = __('Hits','wp-slimstat-view').': '.number_format($results[$i]['count'], 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator).$element_title;
			}

			// Some columns require a special post-treatment
			if ($_column == 'resource' && strpos($_args['custom_where'], '404') === false){
				$element_value = '<a target="_blank" class="url" title="'.__('Open this URL in a new window','wp-slimstat-view').'" href="'.self::$home_url.$results[$i]['resource'].'"></a>'.$element_value;
			}
			if ($_column == 'domain'){
				$element_url = htmlspecialchars((strpos($results[$i]['referer'], '://') == false)?"http://{$results[$i]['domain']}{$results[$i]['referer']}":$results[$i]['referer'], ENT_QUOTES);
				$element_value = '<a target="_blank" class="url" title="'.__('Open this URL in a new window','wp-slimstat-view').'" href="'.$element_url.'"></a>'.$element_value;
			}
			if (!empty($results[$i]['ip']))
				$element_title .= '<br><a target="_blank" title="WHOIS: '.$results[$i]['ip'].'" class="whois" href="'.self::$ip_lookup_url.$results[$i]['ip'].'"></a> IP: <a title="'.sprintf(__('Filter results where IP equals %s','wp-slimstat-view'), $results[$i]['ip']).'" href="'.self::fs_url('ip', $results[$i]['ip']).'">'.$results[$i]['ip'].'</a>'.(!empty($results[$i]['other_ip'])?' / '.long2ip($results[$i]['other_ip']):'');

			echo "<p title='$element_title'>$element_value$percentage</p>";
		}
	}

	public static function show_chart($_id = 'p0', $_chart_data = array()){
		if ($_id != 'p0' && in_array($_id, self::$hidden_boxes)) return;

		if ($_chart_data->current_non_zero_count+$_chart_data->previous_non_zero_count == 0){
			echo '<p class="nodata">'.__('No data to display','wp-slimstat-view').'</p>';
			return;
		}
		else{ 
			$rtl_filler_current = $rtl_filler_previous = 0;
			if ($GLOBALS['wp_locale']->text_direction == 'rtl' && !wp_slimstat_db::$day_filter_active){
				$rtl_filler_current = 31-((date_i18n('Ym') == wp_slimstat_db::$current_date['y'].wp_slimstat_db::$current_date['m'])?wp_slimstat_db::$current_date['d']:cal_days_in_month(CAL_GREGORIAN, wp_slimstat_db::$current_date['m'], wp_slimstat_db::$current_date['y']));
				$rtl_filler_previous = 31-cal_days_in_month(CAL_GREGORIAN, wp_slimstat_db::$previous_month['m'], wp_slimstat_db::$previous_month['y']);
			} ?>
			<div id="chart-placeholder"></div><div id="chart-legend"></div>
			<script type="text/javascript">
				var slimstat_rtl_filler_current = <?php echo $rtl_filler_current ?>;
				var slimstat_rtl_filler_previous = <?php echo $rtl_filler_previous ?>;
				var slimstat_interval = <?php echo !empty(wp_slimstat_db::$filters_parsed['interval'])?wp_slimstat_db::$filters_parsed['interval'][1]:0 ?>;
				var slimstat_day_filter_active = <?php echo !empty(wp_slimstat_db::$day_filter_active)?'true':'false' ?>;
				var slimstat_min_max_ticks="<?php echo $_chart_data->min_max_ticks ?>";
				var slimstat_max_yaxis = <?php echo $_chart_data->max_yaxis ?>;
				var slimstat_current_month = parseInt('<?php echo wp_slimstat_db::$current_date['m'] ?>');
				var slimstat_current_year = parseInt('<?php echo wp_slimstat_db::$current_date['y'] ?>');
				
				// Data to use for the chart
				window.chart_data = [[<?php echo $_chart_data->previous_data ?>],[<?php echo $_chart_data->current_data1 ?>],[<?php echo $_chart_data->current_data2 ?>]];
				window.ticks = [<?php echo $_chart_data->ticks ?>];
				var slimstat_a = {<?php echo !empty($_chart_data->previous_data_label)?"label:'$_chart_data->previous_data_label',data:window.chart_data[0]":''; ?>};
				var slimstat_b = {label:"<?php echo $_chart_data->current_data2_label ?>",data:window.chart_data[2]};
				var slimstat_c = {label:"<?php echo $_chart_data->current_data1_label ?>",data:window.chart_data[1]};
			</script>
			<script src="<?php echo WP_PLUGIN_URL.'/wp-slimstat/admin/view/flot/slimstat.chart.js' ?>" type="text/javascript"></script><?php 
		}
	}
	
	public static function show_spy_view($_id = 'p0', $_type = 'undefined'){
		if ($_id != 'p0' && in_array($_id, self::$hidden_boxes)) return;

		$results = !is_int($_type)?wp_slimstat_db::get_recent('t1.id', '(t1.visit_id > 0 AND tb.type <> 1)', '', '', 't1.visit_id DESC'):wp_slimstat_db::get_recent_outbound($_type);

		if (count($results) == 0) echo '<p class="nodata">'.__('No data to display','wp-slimstat-view').'</p>';

		$visit_id = 0;
		for($i=0;$i<count($results);$i++){
			$element_title = '';
			$results[$i]['ip'] = long2ip($results[$i]['ip']);
			if (!empty($results[$i]['other_ip'])) $results[$i]['other_ip'] = long2ip($results[$i]['other_ip']);
			if (wp_slimstat::$options['convert_ip_addresses'] == 'yes'){
				$host_by_ip = gethostbyaddr($results[$i]['ip']);
				$host_by_ip .= ($host_by_ip != $results[$i]['ip'])?" ({$results[$i]['ip']})":'';
			}
			else{
				$host_by_ip = $results[$i]['ip'];
			}
			$results[$i]['dt'] = date_i18n(wp_slimstat_db::$date_time_format, $results[$i]['dt']);
			if (!empty($results[$i]['searchterms']) && empty($results[$i]['resource'])){
				$results[$i]['resource'] = __('Search for','wp-slimstat-view').': '.$results[$i]['searchterms'];
			}
			if (!empty($results[$i]['resource']) && $_type == 0){
				$results[$i]['resource'] = '<a target="_blank" class="url" title="'.__('Open this URL in a new window','wp-slimstat-view').'" href="'.$results[$i]['resource'].'"></a> '.$results[$i]['resource'];
			}

			if ($visit_id != $results[$i]['visit_id']){
				$highlight_row = !empty($results[$i]['searchterms'])?' is-search-engine':' is-direct';
				if (empty($results[$i]['user'])){
					$host_by_ip = "<a href='".self::fs_url('ip', $results[$i]['ip'])."'>$host_by_ip</a>";
				}
				else{
					$host_by_ip = "<a class='highlight-user' href='".self::fs_url('user', $results[$i]['user'])."'>{$results[$i]['user']}</a>";
					$highlight_row = ' is-known-user';
				}
				$host_by_ip = "<a class='whois' href='".self::$ip_lookup_url."{$results[$i]['ip']}' target='_blank' title='WHOIS: {$results[$i]['ip']}'></a> $host_by_ip";
				$country = ($results[$i]['country'] != 'xx')?__('c-'.$results[$i]['country'], 'countries-languages'):'';
				$other_ip_tag = !empty($results[$i]['other_ip'])?" <span><a href='".self::fs_url('other_ip', $results[$i]['other_ip'])."'>{$results[$i]['other_ip']}</a></span>":'';
		
				echo "<p class='header$highlight_row'>{$host_by_ip} <span>{$results[$i]['dt']}</span> <span>$country</span> $other_ip_tag</p>";
				$visit_id = $results[$i]['visit_id'];
			}

			if (!empty($results[$i]['domain'])){
				if (!is_int($_type)){
					$element_url = htmlspecialchars((strpos($results[$i]['referer'], '://') == false)?"http://{$results[$i]['domain']}{$results[$i]['referer']}":$results[$i]['referer'], ENT_QUOTES);
					$element_title = " title='".__('Source','wp-slimstat-view').": <a target=\"_blank\" class=\"url\" title=\"".__('Open this URL in a new window','wp-slimstat-view')."\" href=\"$element_url\"></a> <a title=\"".sprintf(__('Filter results where domain equals %s','wp-slimstat-view'), $results[$i]['domain'])."\" href=\"".self::fs_url('domain', $results[$i]['domain'])."\">{$results[$i]['domain']}</a>";
					$element_title .= !empty($results[$i]['searchterms'])?" ".__('Keywords','wp-slimstat-view').": <a title=\"".sprintf(__('Filter results where searchterm equals %s','wp-slimstat-view'), htmlspecialchars($results[$i]['searchterms'], ENT_QUOTES))."\" href=\"".self::fs_url('searchterms', $results[$i]['searchterms'])."\">".htmlspecialchars($results[$i]['searchterms'], ENT_QUOTES)."</a>'":"'";
				}
				else{
					$permalink = parse_url($results[$i]['referer']);
					$results[$i]['notes'] = str_replace('|ET:click', '', $results[$i]['notes']);
					$element_url = htmlspecialchars((strpos($results[$i]['referer'], '://') == false)?'http://'.self::$home_url.$results[$i]['referer']:$results[$i]['referer'], ENT_QUOTES);
					$element_title = " title='".__('Source','wp-slimstat-view').": <a target=\"_blank\" class=\"url\" title=\"".__('Open this URL in a new window','wp-slimstat-view')."\" href=\"$element_url\"></a> <a title=\"".sprintf(__('Filter results where resource equals %s','wp-slimstat-view'), $permalink['path'])."\" href=\"".self::fs_url('resource', $permalink['path'])."\">{$permalink['path']}</a>";
					$element_title .= !empty($results[$i]['notes'])?"<br>Link Details: {$results[$i]['notes']}'":"'";
				}
			}
			echo "<p$element_title>{$results[$i]['resource']}</p>";
		}
	}
	
	public static function ajax_show_report(){
		// Make sure the request is coming from the right place
		check_ajax_referer('meta-box-order', 'security');

		// Some boxes need extra information
		switch($_POST['box_id']){
			case '#slim_p1_01':
			case '#slim_p1_03':
				$chart_data = wp_slimstat_db::extract_data_for_chart('COUNT(t1.ip)', 'COUNT(DISTINCT(t1.ip))', __('Pageviews','wp-slimstat-view'), __('Unique IPs','wp-slimstat-view'));
				break;
			case '#slim_p2_01':
				$chart_data = wp_slimstat_db::extract_data_for_chart('COUNT(DISTINCT t1.visit_id)', 'COUNT(DISTINCT t1.ip)', __('Visits','wp-slimstat-view'), __('Unique IPs','wp-slimstat-view'), 'AND (tb.type = 0 OR tb.type = 2)');
				break;
			case '#slim_p3_01':
				$chart_data = wp_slimstat_db::extract_data_for_chart('COUNT(DISTINCT(`domain`))', 'COUNT(DISTINCT(ip))', __('Domains','wp-slimstat-view'), __('Unique IPs','wp-slimstat-view'), "AND domain <> '' AND domain <> '{$_SERVER['SERVER_NAME']}'");
				break;
			case '#slim_p4_01':
				$sql_from_where = " FROM (SELECT t1.visit_id, count(t1.ip) count, MAX(t1.dt) dt FROM [from_tables] WHERE [where_clause] GROUP BY t1.visit_id) AS ts1";
				$chart_data = wp_slimstat_db::extract_data_for_chart('ROUND(AVG(ts1.count),2)', 'MAX(ts1.count)', __('Avg Pageviews','wp-slimstat-view'), __('Longest visit','wp-slimstat-view'), 'AND t1.visit_id > 0', $sql_from_where);
				break;
			default:
		}

//		if($_POST['box_id']=='#slim_p1_03' || $_POST['box_id']=='#slim_p1_08'){
//			$current_pageviews = wp_slimstat_db::count_records();
//		}
//		if ($_POST['box_id']=='#slim_p2_02'){
//			$total_human_hits = wp_slimstat_db::count_records('t1.visit_id > 0');
//			$total_human_visits = wp_slimstat_db::count_records_having('visit_id > 0', 'visit_id');
//		}
		
		switch($_POST['box_id']){
			case '#slim_p1_01':
			case '#slim_p2_01':
			case '#slim_p3_01':
			case '#slim_p4_01':
				self::show_chart('p0', $chart_data);
				break;
			case '#slim_p1_02':
				self::show_about_wpslimstat();
				break;
			case '#slim_p1_03':
				self::show_overview_summary('p0', wp_slimstat_db::count_records(), $chart_data);
				break;
			case '#slim_p1_04':
				self::show_results('recent', 'p0', 'user');
				break;
			case '#slim_p1_05':
			case '#slim_p3_08':
				self::show_spy_view('p0');
				break;
			case '#slim_p1_06':
			case '#slim_p3_09':
				self::show_results('recent', 'p0', 'searchterms');
				break;
			case '#slim_p1_07':
				self::show_results('popular', 'p0', 'language', array('total_for_percentage' => wp_slimstat_db::count_records('t1.visit_id > 0 AND tb.type <> 1'), 'custom_where' => 't1.visit_id > 0 AND tb.type <> 1'));
				break;
			case '#slim_p1_08':
				self::show_results('popular', 'p0', 'resource', array('total_for_percentage' => wp_slimstat_db::count_records()));
				break;
			case '#slim_p1_09':
			case '#slim_p2_13':
			case '#slim_p3_10':
				self::show_results('recent', 'p0', 'country');
				break;
			case '#slim_p1_10':
			case '#slim_p3_05':
				self::show_results('popular_complete', 'p0', 'domain', array('total_for_percentage' => wp_slimstat_db::count_records('t1.referer <> ""')));
				break;
			case '#slim_p1_11':
				self::show_results('popular', 'p0', 'user', array('total_for_percentage' => wp_slimstat_db::count_records('t1.user <> ""')));
				break;
			case '#slim_p1_12':
			case '#slim_p3_03':
			case '#slim_p4_14':
				self::show_results('popular', 'p0', 'searchterms', array('total_for_percentage' => wp_slimstat_db::count_records('t1.searchterms <> ""')));
				break;
			case '#slim_p1_13':
			case '#slim_p2_10':
			case '#slim_p3_04':
				self::show_results('popular', 'p0', 'country', array('total_for_percentage' => wp_slimstat_db::count_records()));
				break;
			case '#slim_p2_02':
				self::show_visitors_summary('p0', wp_slimstat_db::count_records('t1.visit_id > 0 AND tb.type <> 1'), wp_slimstat_db::count_records_having('t1.visit_id > 0 AND tb.type <> 1', 'visit_id'));
				break;
			case '#slim_p2_03':
				self::show_results('popular', 'p0', 'language', array('total_for_percentage' => wp_slimstat_db::count_records()));
				break;
			case '#slim_p2_04':
				self::show_results('popular', 'p0', 'browser', array('total_for_percentage' => wp_slimstat_db::count_records(), 'more_columns' => ',tb.version'));
				break;
			case '#slim_p2_05':
				self::show_results('popular', 'p0', 'ip', array('total_for_percentage' => wp_slimstat_db::count_records()));
				break;
			case '#slim_p2_06':
				self::show_results('popular', 'p0', 'platform', array('total_for_percentage' => wp_slimstat_db::count_records()));
				break;
			case '#slim_p2_07':
				self::show_results('popular', 'p0', 'resolution', array('total_for_percentage' => wp_slimstat_db::count_records('tss.resolution <> ""')));
				break;
			case '#slim_p2_09':
				self::show_plugins('p0', wp_slimstat_db::count_records('t1.visit_id > 0 AND tb.type <> 1'));
				break;
			case '#slim_p2_10':
				wp_slimstat_boxes::show_results('popular', 'p0', 'country', array('total_for_percentage' => wp_slimstat_db::count_records()));
				break;
			case '#slim_p2_12':
				self::show_visit_duration('slim_p2_12', wp_slimstat_db::count_records_having('visit_id > 0', 'visit_id'));
				break;
			case '#slim_p2_14':
				self::show_results('recent', 'p0', 'resolution', array('join_tables' => 'tss.*'));
				break;
			case '#slim_p2_15':
				self::show_results('recent', 'p0', 'platform', array('join_tables' => 'tb.*'));
				break;
			case '#slim_p2_16':
				self::show_results('recent', 'p0', 'browser', array('join_tables' => 'tb.*'));
				break;
			case '#slim_p2_17':
				self::show_results('recent', 'p0', 'language');
				break;
			case '#slim_p3_02':
				self::show_traffic_sources_summary('slim_p3_02', wp_slimstat_db::count_records());
				break;
			case '#slim_p3_06':
				self::show_results('popular_complete', 'slim_p3_06', 'domain', array('total_for_percentage' => wp_slimstat_db::count_records("t1.searchterms <> '' AND t1.domain <> '{$_SERVER['SERVER_NAME']}' AND t1.domain <> ''", 't1.id'), 'custom_where' => "t1.searchterms <> '' AND t1.domain <> '{$_SERVER['SERVER_NAME']}'"));
				break;
			case '#slim_p3_11':
			case '#slim_p4_17':
				self::show_results('popular', 'p0', 'resource', array('total_for_percentage' => wp_slimstat_db::count_records('t1.domain <> ""'), 'custom_where' => 't1.domain <> ""'));
				break;
			case '#slim_p4_02':
				self::show_results('recent', 'p0', 'resource', array('custom_where' => 'tci.content_type = "post"'));
				break;
			case '#slim_p4_03':
				self::show_results('recent', 'p0', 'resource', array('having_clause' => 'HAVING COUNT(visit_id) = 1'));
				break;
			case '#slim_p4_04':
				self::show_results('recent', 'p0', 'resource', array('custom_where' => '(t1.resource LIKE "%/feed%" OR t1.resource LIKE "%?feed=%" OR t1.resource LIKE "%&feed=%" OR tci.content_type LIKE "%feed%")'));
				break;
			case '#slim_p4_05':
				self::show_results('recent', 'p0', 'resource', array('custom_where' => '(t1.resource LIKE "[404]%" OR tci.content_type LIKE "%404%")'));
				break;
			case '#slim_p4_06':
				self::show_results('recent', 'p0', 'searchterms', array('custom_where' => '(t1.resource = "__l_s__" OR t1.resource = "" OR tci.content_type LIKE "%search%")'));
				break;
			case '#slim_p4_07':
				self::show_results('popular', 'p0', 'resource', array('total_for_percentage' => wp_slimstat_db::count_records('(tci.content_type = "category" OR tci.content_type = "tag")'), 'custom_where' => '(tci.content_type = "category" OR tci.content_type = "tag")', 'more_columns' => ',tci.category'));
				break;
			case '#slim_p4_08':
				self::show_spy_view('p0', 0);
				break;
			case '#slim_p4_10':
				self::show_spy_view('p0', -1);
				break;
			case '#slim_p4_11':
				self::show_results('popular', 'p0', 'resource', array('total_for_percentage' => wp_slimstat_db::count_records('tci.content_type = "post"'), 'custom_where' => 'tci.content_type = "post"'));
				break;
			case '#slim_p4_12':
				self::show_results('popular', 'p0', 'resource', array('total_for_percentage' => wp_slimstat_db::count_records('(t1.resource LIKE "%/feed%" OR t1.resource LIKE "%?feed=%" OR t1.resource LIKE "%&feed=%" OR tci.content_type LIKE "%feed%")'), 'custom_where' => '(t1.resource LIKE "%/feed%" OR t1.resource LIKE "%?feed=%" OR t1.resource LIKE "%&feed=%" OR tci.content_type LIKE "%feed%")'));
				break;
			case '#slim_p4_13':
				self::show_results('popular', 'p0', 'searchterms', array('total_for_percentage' => wp_slimstat_db::count_records('(t1.resource = "__l_s__" OR t1.resource = "" OR tci.content_type LIKE "%search%")'), 'custom_where' => '(t1.resource = "__l_s__" OR t1.resource = "" OR tci.content_type LIKE "%search%")'));
				break;
			case '#slim_p4_15':
				self::show_results('recent', 'p0', 'resource', array('custom_where' => '(tci.content_type = "category" OR tci.content_type = "tag")', 'join_tables' => 'tci.*'));
				break;
			case '#slim_p4_16':
				self::show_results('popular', 'p0', 'resource', array('total_for_percentage' => wp_slimstat_db::count_records('(t1.resource LIKE "[404]%" OR tci.content_type LIKE "%404%")'), 'custom_where' => '(t1.resource LIKE "[404]%" OR tci.content_type LIKE "%404%")'));
				break;
			case '#slim_p4_18':
				self::show_results('popular', 'p0', 'author', array('total_for_percentage' => wp_slimstat_db::count_records('tci.author <> ""')));
				break;
			default:
		}
		die();
	}
	
	public static function show_about_wpslimstat($_id = 'p0'){ 
		if ($_id != 'p0' && in_array($_id, self::$hidden_boxes)) return; ?>
		<p><?php _e('Total Pageviews', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records('1=1', '*', false), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
		<p><?php _e('DB Size', 'wp-slimstat-view') ?> <span><?php echo wp_slimstat_db::get_data_size() ?></span></p>
		<p><?php _e('Tracking Active', 'wp-slimstat-view') ?> <span><?php _e(wp_slimstat::$options['is_tracking'], 'countries-languages') ?></span></p>
		<p><?php _e('Javascript Tracking', 'wp-slimstat-view') ?> <span><?php _e(wp_slimstat::$options['enable_javascript'], 'countries-languages') ?></span></p>
		<p><?php _e('Auto purge', 'wp-slimstat-view') ?> <span><?php echo (wp_slimstat::$options['auto_purge'] > 0)?wp_slimstat::$options['auto_purge'].' '.__('days','wp-slimstat-view'):__('No','wp-slimstat-view') ?></span></p>
		<p><?php _e('Latency', 'wp-slimstat-view') ?> <span><?php echo (wp_slimstat::$options['ignore_interval'] > 0)?wp_slimstat::$options['ignore_interval'].' '.__('seconds','wp-slimstat-view'):__('Off','wp-slimstat-view') ?></span></p>
		<p><?php _e('Oldest visit', 'wp-slimstat-view') ?> <span><?php $dt = wp_slimstat_db::get_oldest_visit(); echo ($dt == null)?__('No visits','wp-slimstat-view'):date(get_option('date_format'), $dt) ?></span></p>
		<p>Geo IP <span><?php echo date(get_option('date_format'), @filemtime(WP_PLUGIN_DIR.'/wp-slimstat/admin/geoip.csv')) ?></span></p><?php
	}
	
	public static function show_overview_summary($_id = 'p0', $_current_pageviews = 0, $_chart_data = array()){
		if ($_id != 'p0' && in_array($_id, self::$hidden_boxes)) return;

		$temp_filters_date_sql_where = wp_slimstat_db::$filters_date_sql_where;
		wp_slimstat_db::$filters_date_sql_where = ''; // override date filters
		$today_pageviews = wp_slimstat_db::count_records('t1.dt BETWEEN '.wp_slimstat_db::$current_date['u'].' AND '.(wp_slimstat_db::$current_date['u']+86399));
		$yesterday_pageviews = wp_slimstat_db::count_records('t1.dt BETWEEN '.(wp_slimstat_db::$current_date['u']-86400).' AND '.(wp_slimstat_db::$current_date['u']-1));
		wp_slimstat_db::$filters_date_sql_where = $temp_filters_date_sql_where; ?>
			<p><?php self::inline_help(htmlspecialchars(__('A request to load a single HTML file. WP SlimStat logs a "pageview" each time the tracking code is executed.','wp-slimstat-view'), ENT_QUOTES)) ?>
				<?php _e('Pageviews', 'wp-slimstat-view') ?> <span><?php echo number_format($_current_pageviews, 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<p><?php self::inline_help(htmlspecialchars(__('This counter is based on any user activity in the last 5 minutes.','wp-slimstat-view'), ENT_QUOTES)) ?>
				<?php _e('Last 5 minutes', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records('t1.dt > UNIX_TIMESTAMP()-300', '*', false), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<p><?php self::inline_help(htmlspecialchars(__('How many pages have been visited on average during the current period.','wp-slimstat-view'), ENT_QUOTES)) ?>
				<?php _e('Avg Pageviews', 'wp-slimstat-view') ?> <span><?php echo number_format(($_chart_data->current_non_zero_count > 0)?intval($_current_pageviews/$_chart_data->current_non_zero_count):0, 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<p><?php self::inline_help(htmlspecialchars(__('A bot is a program that operates as an agent for a user or another program or simulates a human activity. Browsers with Javascript disabled (but whose user agent is legit) are not considered <em>bots</em>.','wp-slimstat-view'), ENT_QUOTES)) ?>
				<?php _e('Bots', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records('tb.type = 1'), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<p><?php self::inline_help(htmlspecialchars(__('Visitors who landed on your site after searching for a keyword on Google, Yahoo, etc.','wp-slimstat-view'), ENT_QUOTES)) ?>
				<?php _e('From Search Results', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records('t1.searchterms <> ""'), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<?php if (!wp_slimstat_db::$day_filter_active): ?><p><?php _e('On', 'wp-slimstat-view'); echo ' '.((wp_slimstat_db::$decimal_separator != '.')?wp_slimstat_db::$current_date['d'].'/'.wp_slimstat_db::$current_date['m']:wp_slimstat_db::$current_date['m'].'/'.wp_slimstat_db::$current_date['d']) ?> <span><?php echo number_format($today_pageviews, 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p><?php endif ?>
			<p><?php _e('On', 'wp-slimstat-view'); echo ' '.((wp_slimstat_db::$decimal_separator != '.')?wp_slimstat_db::$yesterday['d'].'/'.wp_slimstat_db::$yesterday['m']:wp_slimstat_db::$yesterday['m'].'/'.wp_slimstat_db::$yesterday['d']) ?> <span><?php echo number_format($yesterday_pageviews, 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<?php if (!wp_slimstat_db::$day_filter_active): ?><p><?php _e('Last Month', 'wp-slimstat-view'); ?> <span><?php echo number_format($_chart_data->previous_total, 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p><?php endif;
	}
	
	public static function show_visitors_summary($_id = 'p0', $_total_human_hits = 0, $_total_human_visits = 0){
		if ($_id != 'p0' && in_array($_id, self::$hidden_boxes)) return;

		$new_visitors = wp_slimstat_db::count_records_having('visit_id > 0', 'ip', 'COUNT(visit_id) = 1');
		$bounce_rate = ($_total_human_hits > 0)?sprintf("%01.2f", (100*$new_visitors/$_total_human_hits)):0;
		if (intval($bounce_rate) > 99) $bounce_rate = '100';
		$metrics_per_visit = wp_slimstat_db::get_max_and_average_pages_per_visit(); ?>
			<p><?php self::inline_help(htmlspecialchars(__('A visit is a session of at most 30 minutes. Returning visitors are counted multiple times if they perform multiple visits.','wp-slimstat-view'), ENT_QUOTES)) ?>
				<?php _e('Human visits', 'wp-slimstat-view') ?> <span><?php echo number_format($_total_human_visits, 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<p><?php self::inline_help(htmlspecialchars(__('This number includes <strong>human visits</strong> only.','wp-slimstat-view'), ENT_QUOTES)) ?>
				<?php _e('Unique IPs', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records('t1.visit_id > 0 AND tb.type <> 1', 't1.ip'), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<p><?php self::inline_help(htmlspecialchars(__('Percentage of single-page visits, i.e. visits in which the person left your site from the entrance page.','wp-slimstat-view'), ENT_QUOTES)) ?>
				<?php _e('Bounce rate', 'wp-slimstat-view') ?> <span><?php echo number_format($bounce_rate, 2, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?>%</span></p>
			<p><?php self::inline_help(htmlspecialchars(__('Visitors who had previously left a comment on your blog.','wp-slimstat-view'), ENT_QUOTES)) ?>
				<?php _e('Known visitors', 'wp-slimstat-view') ?> <span><?php echo wp_slimstat_db::count_records('t1.user <> ""', 't1.user') ?></span></p>
			<p><?php self::inline_help(htmlspecialchars(__('Human users who visited your site only once.','wp-slimstat-view'), ENT_QUOTES)) ?>
				<?php _e('New visitors', 'wp-slimstat-view') ?> <span><?php echo number_format($new_visitors, 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<p><?php _e('Bots', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records('tb.type = 1'), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<p><?php _e('Pages per visit', 'wp-slimstat-view') ?> <span><?php echo number_format($metrics_per_visit['avg'], 2, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
			<p><?php _e('Longest visit', 'wp-slimstat-view') ?> <span><?php echo number_format($metrics_per_visit['max'], 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator).' '.__('hits','wp-slimstat-view') ?></span></p><?php
	}

	public static function show_plugins($_id = 'p0', $_total_human_hits = 0){
		if ($_id != 'p0' && in_array($_id, self::$hidden_boxes)) return;

		$wp_slim_plugins = array('flash', 'silverlight', 'acrobat', 'java', 'mediaplayer', 'director', 'real', 'quicktime');
		foreach($wp_slim_plugins as $i => $a_plugin){
			$count_results = wp_slimstat_db::count_records("t1.plugins LIKE '%{$a_plugin}%'");
			echo "<p title='".__('Hits','wp-slimstat-view').": $count_results'>".ucfirst($a_plugin).' <span>';
			echo ($_total_human_hits > 0)?number_format(sprintf("%01.2f", (100*$count_results/$_total_human_hits)), 2, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator):0;
			echo '%</span></p>';
		}
	}
	
	public static function show_visit_duration($_id = 'p0', $_total_human_visits = 0){
		if ($_id != 'p0' && in_array($_id, self::$hidden_boxes)) return;

		$count = wp_slimstat_db::count_records_having('visit_id > 0', 'visit_id', 'max(dt) - min(dt) >= 0 AND max(dt) - min(dt) <= 30');
		$percentage = ($_total_human_visits > 0)?sprintf("%01.2f", (100*$count/$_total_human_visits)):0;
		$extra_info =  "title='".__('Hits','wp-slimstat-view').": {$count}'";
		echo "<p $extra_info>".__('0 - 30 seconds','wp-slimstat-view')." <span>$percentage%</span></p>";

		$count = wp_slimstat_db::count_records_having('visit_id > 0', 'visit_id', 'max(dt) - min(dt) > 30 AND max(dt) - min(dt) <= 60');
		$percentage = ($_total_human_visits > 0)?sprintf("%01.2f", (100*$count/$_total_human_visits)):0;
		$extra_info =  "title='".__('Hits','wp-slimstat-view').": {$count}'";
		echo "<p $extra_info>".__('31 - 60 seconds','wp-slimstat-view')." <span>$percentage%</span></p>";

		$count = wp_slimstat_db::count_records_having('visit_id > 0', 'visit_id', 'max(dt) - min(dt) > 60 AND max(dt) - min(dt) <= 180');
		$percentage = ($_total_human_visits > 0)?sprintf("%01.2f", (100*$count/$_total_human_visits)):0;
		$extra_info =  "title='".__('Hits','wp-slimstat-view').": {$count}'";
		echo "<p $extra_info>".__('1 - 3 minutes','wp-slimstat-view')." <span>$percentage%</span></p>";

		$count = wp_slimstat_db::count_records_having('visit_id > 0', 'visit_id', 'max(dt) - min(dt) > 180 AND max(dt) - min(dt) <= 300');
		$percentage = ($_total_human_visits > 0)?sprintf("%01.2f", (100*$count/$_total_human_visits)):0;
		$extra_info =  "title='".__('Hits','wp-slimstat-view').": {$count}'";
		echo "<p $extra_info>".__('3 - 5 minutes','wp-slimstat-view')." <span>$percentage%</span></p>";

		$count = wp_slimstat_db::count_records_having('visit_id > 0', 'visit_id', 'max(dt) - min(dt) > 300 AND max(dt) - min(dt) <= 420');
		$percentage = ($_total_human_visits > 0)?sprintf("%01.2f", (100*$count/$_total_human_visits)):0;
		$extra_info =  "title='".__('Hits','wp-slimstat-view').": {$count}'";
		echo "<p $extra_info>".__('5 - 7 minutes','wp-slimstat-view')." <span>$percentage%</span></p>";

		$count = wp_slimstat_db::count_records_having('visit_id > 0', 'visit_id', 'max(dt) - min(dt) > 420 AND max(dt) - min(dt) <= 600');
		$percentage = ($_total_human_visits > 0)?sprintf("%01.2f", (100*$count/$_total_human_visits)):0;
		$extra_info =  "title='".__('Hits','wp-slimstat-view').": {$count}'";
		echo "<p $extra_info>".__('7 - 10 minutes','wp-slimstat-view')." <span>$percentage%</span></p>";

		$count = wp_slimstat_db::count_records_having('visit_id > 0', 'visit_id', 'max(dt) - min(dt) > 600 AND max(dt) - min(dt) <= 1200');
		$percentage = ($_total_human_visits > 0)?sprintf("%01.2f", (100*$count/$_total_human_visits)):0;
		$extra_info =  "title='".__('Hits','wp-slimstat-view').": {$count}'";
		echo "<p $extra_info>".__('10 - 20 minutes','wp-slimstat-view')." <span>$percentage%</span></p>";

		$count = wp_slimstat_db::count_records_having('visit_id > 0', 'visit_id', 'max(dt) - min(dt) > 1200');
		$percentage = ($_total_human_visits > 0)?sprintf("%01.2f", (100*$count/$_total_human_visits)):0;
		$extra_info =  "title='".__('Hits','wp-slimstat-view').": {$count}'";
		echo "<p $extra_info>".__('More than 20 minutes','wp-slimstat-view')." <span>$percentage%</span></p>";
	}
	
	public static function show_traffic_sources_summary($_id = 'p0', $_current_pageviews = 0){
		if ($_id != 'p0' && in_array($_id, self::$hidden_boxes)) return; 
		$total_human_hits = wp_slimstat_db::count_records('t1.visit_id > 0 AND tb.type <> 1');
		$new_visitors = wp_slimstat_db::count_records_having('visit_id > 0', 'ip', 'COUNT(visit_id) = 1');
		$bounce_rate = ($total_human_hits > 0)?sprintf("%01.2f", (100*$new_visitors/$total_human_hits)):0;
		if (intval($bounce_rate) > 99) $bounce_rate = '100'; ?>		
		<p><?php self::inline_help(htmlspecialchars(__('A request to load a single HTML file. WP SlimStat logs a "pageview" each time the tracking code is executed.','wp-slimstat-view'), ENT_QUOTES)) ?>
			<?php _e('Pageviews', 'wp-slimstat-view') ?> <span><?php echo number_format($_current_pageviews, 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
		<p><?php self::inline_help(htmlspecialchars(__('A referrer (or referring site) is the site that a visitor previously visited before following a link to your site.','wp-slimstat-view'), ENT_QUOTES)) ?>
			<?php _e('Unique Referrers', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records("t1.domain <> '{$_SERVER['SERVER_NAME']}' AND t1.domain <> ''", 't1.domain'), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
		<p><?php self::inline_help(htmlspecialchars(__("Visitors who visited the site by typing the URL directly into their browser. <em>Direct</em> can also refer to the visitors who clicked on the links from their bookmarks/favorites, untagged links within emails, or links from documents that don't include tracking variables.",'wp-slimstat-view'), ENT_QUOTES)) ?>
			<?php _e('Direct Pageviews', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records('t1.domain = ""', 't1.id'), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
		<p><?php self::inline_help(htmlspecialchars(__("Visitors who came to your site via searches on Google or some other search engine.",'wp-slimstat-view'), ENT_QUOTES)) ?>
			<?php _e('From a search result', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records("t1.searchterms <> '' AND t1.domain <> '{$_SERVER['SERVER_NAME']}' AND t1.domain <> ''", 't1.id'), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
		<p><?php self::inline_help(htmlspecialchars(__("The first page that a user views during a session. This is also known as the <em>entrance page</em>. For example, if they search for 'Brooklyn Office Space,' and they land on your home page, it gets counted (for that visit) as a landing page.",'wp-slimstat-view'), ENT_QUOTES)) ?>
			<?php _e('Unique Landing Pages', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records('t1.domain <> ""', 't1.resource'), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
		<p><?php self::inline_help(htmlspecialchars(__("Number of single-page visits to your site over the selected period.",'wp-slimstat-view'), ENT_QUOTES)) ?>
			<?php _e('Bounce Pages', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_bouncing_pages(), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p>
		<p><?php self::inline_help(htmlspecialchars(__('Percentage of single-page visits, i.e. visits in which the person left your site from the entrance page.','wp-slimstat-view'), ENT_QUOTES)) ?>
			<?php _e('Bounce rate', 'wp-slimstat-view') ?> <span><?php echo number_format($bounce_rate, 2, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?>%</span></p>
		<p><?php self::inline_help(htmlspecialchars(__("Visitors who visited the site in the last 5 minutes coming from a search engine.",'wp-slimstat-view'), ENT_QUOTES)) ?>
			<?php _e('Currently from search engines', 'wp-slimstat-view') ?> <span><?php echo number_format(wp_slimstat_db::count_records("t1.searchterms <> '' AND t1.domain <> '{$_SERVER['SERVER_NAME']}' AND t1.domain <> '' AND t1.dt > UNIX_TIMESTAMP()-300", 't1.id', false), 0, wp_slimstat_db::$decimal_separator, wp_slimstat_db::$thousand_separator) ?></span></p><?php
	}
}