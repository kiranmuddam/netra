$(document).ready(function(){
	$.ajax({
		url: "http://localhost/netra/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var total_data_count = [];
			var date = [];

			for(var i in data) {
				date.push(data[i].date);
				total_data_count.push(data[i].total_data_count);
			}

			var chartdata = {
				labels: date,
				datasets : [
					{
						label: 'Total Number Of Captures By Day',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: total_data_count
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});