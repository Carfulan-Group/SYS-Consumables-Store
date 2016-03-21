<html>
<head>
	<meta charset="UTF-8">
	<title>React | Api</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
</head>
<body>
<div class="app"></div>
<script type="text/babel">
	var pageSlug = "my-consumables";
	var apiBase = "/consumables/wp-json/wp/v2/";
	var $ = jQuery;
	var url = apiBase + "pages?filter[name]=my-consumables&type[0]=post&type[1]=page";

	var TestContent = React.createClass({

			getInitialState : function () {
				return {
		      		title : "",
		        	permalink : "",
		        	urmum : "",
		        	styles : {
		        		color : "",
		        		background : ""
		        	},
		        	colorChanged : false
				};
			},

			getData : function () {
				this.serverRequest = $.get(this.props.source, function (result) {
					var data = result[0];
			      	this.setState({
			      		title : data.title.rendered,
			        	permalink : data.link,
			        	urmum : data.acf.mum
					});
				}.bind(this));
			},

			changeColor : function () {
				if ( this.state.colorChanged == true ) {
					this.setState({
						styles : {
							color : "#000",
							background : "#fff"
						},
						colorChanged : false
					});
				} else {
					this.setState({
						styles : {
							color : "red",
							background : "black"
						},
						colorChanged : true
					});
				}
			},


			render : function () {
				return (
					<div>
						<h1><a href={this.state.permalink}>{this.state.title}</a></h1>
						<p onClick={this.changeColor} style={this.state.styles}>{this.state.urmum}</p>
						<p onClick={this.getData}>click here for content</p>
					</div>
				);
			}
	});

	ReactDOM.render(
		<TestContent source={url}/>,
		document.querySelector('.app')
	);



</script>

</body>
</html>