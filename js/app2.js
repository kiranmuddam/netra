$(document).ready(function(){
	$.ajax({
		url: "http://localhost/netra/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var alerts_count = [];
			var date = [];

			for(var i in data) {
				date.push(data[i].date);
				alerts_count.push(data[i].alerts_count);
			}

			var chartdata = {
				labels: date,
				datasets : [
					{
						label: 'Total Alerts By Day',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: alerts_count
					}
				]
			};

			var ctx = $("#mycanvas2");

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