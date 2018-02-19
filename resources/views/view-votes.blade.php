<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{csrf_token()}}">
<meta charset="utf-8">
<head>
	<title>View Results</title>
	<link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
    <style>
    	.title{
    		font-family: Montserrat;
    		font-size: 40px;
    		text-align: center;
    	}

    	hr{
    		border: 3px solid #00d1b2;
    		width: 40%;
    		position: relative;
    		left: 30%; 
    	}
    </style>
</head>
<body>
	<div id="root">
		<hero link="/view-votes"> </hero>
		@foreach($result as $position)
			<h1 class="title"> {{$position['name'] }} </h1> <hr>
			<result-card :candidates="{{$position['candidates']}}" > </result-card>

		@endforeach	
	</div>
</body>
</html>

<script type="text/javascript" src="js/result.js"></script>