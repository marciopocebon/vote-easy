require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();

window.app = new Vue({
	el: '#root',
	data: {

	},
	created(){
		this.fetchVotes();
	},
	methods: {
		fetchVotes(){
			self = this;
			axios.get('api/get-votes')
				.then((data)=>{
					var posts = data.data;
					console.log(posts);
					var keys = Object.keys(posts);
					keys.forEach((k)=>{
						console.log(k);
						self.renderChart(posts[k]);
					});
					
				})
				.catch((e)=>{
					console.log(e);
				});
		},

		renderChart(candidate){
			var candidateItems = new Array();
			var counter = 0;

			candidate.candidates.forEach((c)=>{
				candidateItems[counter] = { 
					name: (c.first_name + ' ' + c.last_name), 
					y: (c.votes === null ? 0 : c.votes.count) 
				};
				counter++;
			});

			CanvasJS.addColorSet("greenShades", 
			[
				"#2F4F4F",
				"#008080",
				"#2E8B57",
				"#3CB371",
				"#90EE90"                
			]);

			var chart = new CanvasJS.Chart(candidate.name, {
				colorSet: "greenShades",
				title:{
					text: candidate.name            
				},
				legend: {
					cursor: "pointer",
					fontSize: 18,
					fontFamily: "Montserrat",
					itemclick: self.explodePie
				},
				toolTip: {
					borderColor: "Black",
					fontColor: "White",
					backgroundColor: "Black"
				},
				data: [              
					{
						type: "pie",
						showInLegend: true,
						indexLabelPlacement: "outside",
						indexLabelOrientation: "vertical",
						indexLabelFontFamily: "Montserrat",
						indexLabelFontSize: 20,
						indexLabel: "{name}: {y} votes",
						toolTipContent: "{name}: <strong> {y} votes </strong>",
						dataPoints: candidateItems
					}
				]
			});
			chart.render();
		},	
		explodePie(e){
			if(typeof(e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded){
				e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
			} 
			else{
				e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
			}
			e.chart.render();
		}
	}
});