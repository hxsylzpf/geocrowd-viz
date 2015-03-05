<script>
    var $datasets = <?php echo json_encode($datasets); ?>;
</script>

<body onload="load()">

	<div id="notification"></div>
	<div id="tabs_dataset">
		<ul>
			<p>
				<b>Prepared Datasets</b>
			</p>
			<li><a href="#tabs_dataset_1">(1) Publish Clean Data</a></li>
			<li selected><a href="#tabs_dataset_2">(2) Select A Dataset</a></li>

		</ul>

		<div id="tabs_dataset_1">
			<div id="tabs_setting_1">
				<table>
					<tr>
						<td>Dataset
							<div id='jqxdropdown_datasetsx'></div>
						</td>
						<td>Budget Parameter
							<div id='jqxdropdown_budget_parameter'></div>
						</td>
					</tr>
					<tr>
						<td>Privacy Budget
							<div id='jqxdropdown_privacy_budget'></div>
						</td>
						<td>Customized Granularity
							<div id='jqxdropdown_granularity'></div>
						</td>
					</tr>
					<tr>
						<td>

							<form action="index.php/geocast/upload_form" method="post" target="_blank">
								<button class="large blue awesome" type="submit" type="submit"
									value="Upload Dataset" id="upload_datastet">Upload Dataset</button>
							</form>
						</td>
						<td>
							<button class="large blue awesome" type="button"
								value="Publish Data" id="publish_data" onClick="publishData()">Publish
								Data</button>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div id="tabs_dataset_2">
			<table>
				<tr>
					<td>
						<table>
							<tr>
								<td><b>Dataset</b></td>
							</tr>
							<tr>
								<td>
									<div id='jqxdropdown_dataset'></div>
								</td>
							</tr>
							<tr>
								<td><input type="button" onclick="toggleHeatmap()" id="heatmap"
									value="Show Heatmap" /></td>
							</tr>
							<tr>
								<td><input type="button" onclick="toggleBoundary()"
									id="boundary" value="Hide Boundary" /></td>
							</tr>

						</table>
					</td>
					<td>
						<table>
							<tr>
								<td><b>Statistics</b></b></td>
								<td></td>
							</tr>
							<tr>
								<td>Number of workers</td>
								<td align="right"><label id="label_worker_count"></label></td>
							</tr>
							<tr>
								<td>Max travel dist (km)</td>
								<td align="right"><label id="label_mtd"></label></td>
							</tr>
							<tr>
								<td>Area (&#x33a2;)</td>
								<td align="right"><label id="label_area"></label></td>
							</tr>
							<tr>
								<td>Pearson skewness</td>
								<td align="right"><label id="label_pearson_skewness"></label></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</div>



	<div id="tabs_setting">
		<ul>
			<p>
				<b>Geocast Region Construction Parameters</b>
			</p>
			<li><a href="#tabs_setting_1">(3) Algorithm Parameters</a></li>
			<li><a href="#tabs_setting_2">GUI Parameters</a></li>
		</ul>

		<div id="tabs_setting_1">

			<table>
				<tr>
					<td>Heuristic
						<div id='jqxdropdown_heuristic'></div>
					</td>
					<td>Sub-cell Opt
						<div id='jqxdropdown_subcell'></div>
					</td>
					<td>Expected Utility
						<div id='jqxdropdown_expected_utility'></div>
					</td>
				</tr>

				<tr>
					<td>Acceptance Rate (AR)
						<div id='jqxdropdown_acceptance_rate'></div>
					</td>
					<td>Maximum AR
						<div id='jqxdropdown_maximum_acceptance_rate'></div>
					</td>
					<td>Wireless Range (m)
						<div id='jqxdropdown_wireless_range'></div>
					</td>
				</tr>

				<tr>
					<td></td>
					<td align="center">
						<button class="large blue awesome" type="button" value="Update"
							id="update_param" onClick="updateParams()">Update</button>
					</td>
					<td></td>
				</tr>

			</table>


		</div>

		<div id="tabs_setting_2">
			<div>
				<form name="GUI_delay" action="geocast_view.php"
					onsubmit="setDelay();
                          return false">
					Geocast Delay (ms) <input type="text"
						style="width: 100px; padding: 2px" name="delay" value="100"><br>
					<button class="large blue awesome" type="submit" value="Submit">Update</button>
				</form>
			</div>
			<div>
				<input type="checkbox" value="CSS3" id="checkShowBoundingCircle"
					checked> Show GR's bounding circle
			</div>

		</div>

	</div>

	<div id="tabs_query">
		<ul>
			<p>
				<b>(4) Geocast Queries</b>
			</p>
			<li><a href="#tabs_query_1">History</a></li>
			<li><a href="#tabs_query_2">Test</a></li>
		</ul>

		<div id="tabs_query_1">
			<div id="auto-row" colspan="1"></div>
		</div>

		<div id="tabs_query_2">
			<form name="input" action="home.php"
				onsubmit="drawTestTask();
                          return false">
				Task (lat,lng) <input type="text" name="coordinate"><br>
				<button class="large blue awesome" type="submit" value="Submit">Submit</button>
			</form>
		</div>
	</div>

	<div id="clear_map">
		<button class="large blue awesome" type="button" value="Clear map"
			onClick="clearMap()">Clear Map</button>
	</div>

	<div id="reset">
		<button class="large blue awesome" type="button" value="Reset"
			onClick="resetData()">Reset Data</button>
	</div>

	<div id="map_canvas"></div>

	<div>
		<ul id="panels_mobility">
			<div class="k-block">
				<div class="k-header">Moving Workers</div>
				<button class="large blue awesome" type="button"
					value="Start Simulation" id="start_mobility"
					onClick="startSimulation()">Start Simulation</button>
				<progress id="progressbar" hidden="true"></progress>
				<label id="label_iter_count"></label>
				<button class="large blue awesome" type="button"
					value="Start Simulation" id="stop_mobility"
					onClick="stopSimulation()">Stop Simulation</button>
			</div>
		</ul>
	</div>

	<div>
		<ul id="panels_marker_types">
			<div class="k-block">
				<div class="k-header">Marker types</div>
				<img src="res/images/mm_20_red.png" alt="some_text"> Task </br> <img
					src="res/images/mm_20_yellow.png" alt="some_text"> Geocasting
				workers </br> <img src="res/images/mm_20_green.png" alt="some_text">
				Performing worker (FCFS)
		
		</ul>

	</div>
	</ul>
	</div>

	<div>
		<ul id="panels_instruction">
			<div class="k-block">
				<div class="k-header">Usage Instruction</div>
				<ol>
					<li>Cell service provider publishes dataset with privacy protection</li>
					<li>SC-server selects a dataset to query</li>
					<li>SC-server chooses algorithm parameter settings</li>
					<li>Administrator performs geocast queries on map-based interface</li>
				</ol>
			</div>
		</ul>
	</div>

</body>
