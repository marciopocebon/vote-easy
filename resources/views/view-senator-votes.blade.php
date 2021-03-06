<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <title>View Senator Results</title>
    <link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <style type="text/css">
       h1{
        font-family: Helveticaneue;
        font-size: 40px;
        text-align: center;
        padding-bottom: 10px;
        position: relative;
        color: black;
       }

       .input{
        width: 400px;
        box-shadow: none;
       }

       select{
        width: 300px;
       }


       input[type=submit]{
        width: 300px;
        position: relative;
        left: 440px;
       }

       .heh{
        font-family: Montserrat;
        border: 2px solid #b9382e;
       }

       .green{
        border: 2px solid #5eaa4d;
       }

       .empty{
       	text-align: center;
		border: 4px solid #ff3860;
		box-shadow: none;
		}

        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>
    <div id="root" v-cloak>
        <dashboard :link="'/view-votes-senators'" admin={{$admin}}>
            <div class="box">
                <form method="POST" action="/import" enctype="multipart/form-data" class="" @submit.prevent="fetchSenatorResults">
                    <h1>View Hall Senator Results</h1>


                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Hall + Floor: </label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control is-expanded">
                                    <div class="select">
                                        <select name="hall" v-model="hall">
                                            <option value="" disabled="">Select Hall</option>
                                            @foreach($halls as $hall)
                                                <option value="{{$hall}}">{{$hall}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control is-expanded">
                                    <div class="select">
                                        <select name="block" v-model="block">
                                            <option value="" disabled="">Select Block</option>
                                            @foreach($blocks as $block)
                                                <option value="{{$block}}">{{$block}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                
                    <div class="field">
                        <div class="control">
                          <input type="submit" name="Submit" value="Submit" class="button is-dark is-medium">  
                        </div>
                    </div>
                </form>
            </div>

            <div class="content">
            	<modal v-if="uncomplete" :green="false" @close="uncomplete=false">Sorry please select all fields!</modal>
            	<h1 v-if="loading">Loading...</h1>
            	<stat-card v-if="empty" :empty="empty" :message="message"> </stat-card>
            	<senator-chart> </senator-chart>
            </div>
        </dashboard>
    </div>

</body>
</html>
<script type="text/javascript" src="js/canvasjs.min.js"></script>
<script type="text/javascript" src="js/result.js"></script>