<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/ico/favicon.ico">
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script src="/js/d3.parcoords_per.js"></script>
	<script src="/js/underscore.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/d3.parcoords.css">
	<link rel="stylesheet" type="text/css" href="/css/bubbleChart.css">
	
    <title>Romain WARLOP</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
	<link href="/css/crossfilter.css" rel="stylesheet">
	<link href="/dc.js-1.7.0/dc.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body>

<?php include($_SERVER['DOCUMENT_ROOT'].'/navbar.php'); ?>

<div class="container-fluid">
  <div class="row">
	
	<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 main">
	  <!--<h1 class="page-header">Premier League Champion</h1>-->
	  <ul class="nav nav-tabs">
		  <li class="active"><a href="#" style="font-weight:bold;">Can tennis make me rich ?</a></li>
		  <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			  Dropdown <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
			  <li><a href="#modelconstruction"><strong>Model construction</strong></a></li>
			  <li><a href="#strength">Strength</a></li>
			  <li><a href="#dynamic">Dynamic</a></li>
			  <li><a href="#psychologicalascendant">Psychological Ascendant</a></li>
			  <li><a href="#tiredness">Tiredness</a></li>
			  <li><a href="#context">Context</a></li>
			  <li class="divider"></li>
			  <li><a href="#dimReduct">Dimensionality Reduction</a></li>
			  <li class="divider"></li>
			  <li><a href="#results"><strong>Results</strong></a></li>
			</ul>
			<li class="lastupdate">Last Update - 2015/01/31 - 99%</li>
		  </li>
		</ul>
	</br>
	
	<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Abstract</h3>
	</div>
	<div class="panel-body">
	This article is not totally complete, I'll try to find time to do so, but I think that the methodology can be interesting. </br>
	I always had the feeling that with a good algorithm, it's possible to have a good confidence about knowing who to bet on in sport. Sure,
	it won't be an unrisked strategy, or if I would have find such an algorithm, you wouldn't be reading about it by now ! But if you find such, 
	feel free to contact me ;) </br>
	Even if I do have in mind the fact that "if they do that, it's because they win at the end", I may found an algorithm that will lower my risk 
	by giving me good prediction given the history and a confidence interval, preventing me from remembering all the history of each player, and 
	maybe it will make me little money ! For several reason I think it may be possible.</br>
	The first one is that I think that they and I don't have the same output to predict.
	If I were to design an algorithm for a bet institution, I wouldn't predict who will win the match, but what will be the distribution of the bets 
	for each team. Let's give an example with the last football world cup. I leave in France. In quarter-final there were France vs Germany. Around me everybody 
	bet France, and I amuse that
	in Germany everybody bet Germany. So if as a bet institution I only predict who will win to compute my odds, and predicted Germany as a winner in France,
	if France win I will lose money because most people would bet France. On the other hand, if I know the distribution of the bets, I can choose my odds in 
	order to be winning regardless the winner of the match. </br>
	The second reason is that I can use as an input for my model the odds computed by the bet institution. And their scores reflects a non linear and non trivial 
	informations about the game. </br>
	The third reason is that I can construct a strategy of bets knowing the global precision of my model. Let's take a simplified example and suppose I have a good
	algorithm : if I'm wrong I give them y and if I'm right they give me (1+x)*y. Moreover, let's suppose that I tested my algorithm, and I know I'm right 4 times over 5. 
	So I have to bet on matchs such that the money I will get the 4 rights times is greater than the money I will lose the fifth time : </br>
	4*(1+x)*y-4*y > y. So if x>0.25, I'm winning ! Of course, the precision of my model will be lower in tight match, and when my precision will be good 
	x will be closer to 0.01 I think. So I think a strategy exists, if and only if I have a really really good model for tight matchs. </br>
	<h4>But why tennis ? </h4>
	First, I like tennis, so it's easier for me to think about good variables that would impact the result. Second, I have to limit the biais, and I think the biais 
	is lower in tennis than in other sports like football for instance. To me it's a question of convergence and personal motivation. The biais is smaller in indivual 
	sport because during a match the pressure is always on you, and to keep winning you  must be always at your top. Regarding the convergence, scoring in tennis is much 
	more frequent than in football where just one mistake could cost you a goal and the match whereas in tennis, you could always come back.
	</br></br>
	I get all the data from <a href="http://tennis-data.co.uk/" target=_blanck>here</a>. I take the match from 2006 to 2014. They have data since 2000 but for 2000 
	they don't have the bet and for 2005 they don't have the number of points of a match, so I started in 2006, which gives me 23 942 matchs. Then I suppressed the 
	line where one of the player's rank was greater than 100, because too little observations are available for such player and a top 10 against a top 100 needs no 
	modelisation to predict with a good confidence rate who will win... I ended up with 15 338 matchs.
	</div>
	</div>
	
	<div class="panel panel-warning">
	<div class="panel-heading">
		<h3 class="panel-title">Goal</h3>
	</div>
	<div class="panel-body">
	The goal of this article is not to try hundreds of algorithms to get the best one as we could do for a Kaggle challenge (because I have no time for this) but to try and present 
	different machine learning techniques applied to a real world and fun project. Maybe later I will post and second article on the same dataset to try and compare and different 
	methodology. I'm writing this article while coding the algorithm thus I don't know what it will give but I have in mind a methodology that I want to test, that will mix EM algorithm, 
	non linear dimensionality reduction and kernel method. I will thus give the steps and functions used for the prediction and the precision obtain for different variations (size of the 
	dimensionality reduction and kernel choice). Feel free to adapt and improve the code and also extract a strategy based on the precision in function of the match incertitude 
	as describe above. Tell me if you get rich ;).
	</div>
	</div>
	
	<div class="row">
	<h2 id="modelconstruction" class="sub-header"> Model construction</h2>
	In order to construct an effective model, I first tried to list what are the key point that will lead to a player to win the match. For each key point
	I will then compute variables and features. My distinction between variable and feature is that a variable is the result of a frequency count (for 
	instance the winning rate) and a feature is a combination/transformation of variables. Each key point impact will be validated graphically and 
	mathematically. Given those key features, I will finally be able to develop the model and make the prediction. 
	</br>
	The key point I think about are :
	<ul>
		<li>The relative strength of the players</li>
		<li>The relative dynamic of the players (winning trend)</li>
		<li>Who has the psychological ascendant ? </li>
		<li>The tiredness</li>
		<li>The context advantage (who is the best on this specific surface, indoor/outdoor, tournament, ...)</li>
	</ul>
	</br></br>
	A visualisation of those key point for each match in my dataset will be available in the viz part <a href="/viz/tennisKeyPoint.php">here</a>.
	</div>
	
	<div class="row">
		<center><h3 id="strength">Strength<img src="/images/strength.jpg" class="title_logo"></h3></center>
		
	In order to measure the relative strength of the players, one needs their ATP points, their global and per surface winning rates and their trophies
	(Grand Slam + Master Cup, Master 1000, ATP 500, ATP 250). For winning rate variables I computed a ratio between player 1 and player 2, so a variable 
	of 1 correspond to a same strength. For the trophies, I compute the difference of trophies divided by the max number so this gives me a percentage of
	more (or less) trophies player 1 has compared to player 2. For the ATP points, I computed the difference divided by the minimum of the two ATP points,
	in order to have a higher score when the worst ranked player has little ATP points.	Thus, a difference of 200 points between high ranked players will 
	give lower difference than between two low ranked players who have difficulties to win 200 points. I prefer the ATP points to the rank because the rank 
	gives the same difference between player 3 and 4 then between player 43 and 44 (which is much more thin).</br>
	This gives me for each match two strengths vectors (player 1 relative to player 2 and player 2 relative to player 1) s of dimension 9. From this dataset, 
	I performed dimensionality reduction by applying an <a href="http://en.wikipedia.org/wiki/Expectation%E2%80%93maximization_algorithm" target=_blank>EM 
	algorithm</a> with K clusters in order to take into account non-linearity effects. In order to choose the number K of clusters, I performed an EM algorithm 
	for K from 3 to 15 and plotted the winning rate by cluster for each K. My will was to have a least one cluster with a high winning rate, one with a low and 
	one around 50%, no matter if several cluster would have a similar winning rate, maybe they will	help to differentiate once crossed with the other keys. See 
	<a href="#EMalgorithms">here</a> for the plot for each key point. I end up with for each match two vectors s' of dimension 11 where the k-th value correspond 
	the probability of this relative strength to belong to cluster k. To choose the value of K, I performed several K-means for K from 3 to 20 and then use the 
	elbow method to determine the region of optimal K (around 11-12) and choose the best among this region graphically.</br></br>
	<center><div id="strengthKinetic"></div></center>
	</div>

	<div class="row">
		<center><h3 id="dynamic">Dynamic<img src="/images/dynamic.jpg" class="title_logo"></h3></center>
	The dynamic of a player is the conjunction of two things : his current winning rate compared to his global winning rate and his number of match played rate 
	by day during the last period. For the first one I computed for each player the ratio between his winning rate of the last two weeks, one month, three months 
	and his	global past winning rate. For the second one I computed the number of match and sets played during the same three periods. This gives me 9 variables 
	for each player, and their relative dynamic comes from their ratio. I then performed the same dimensionality reduction through EM algorithm with 3 to 10 clusters 
	following the same process as for strength (<a href="#EMalgorithms">results</a>). Here the elbow method gives a K region around 7-8. I chose K=9.
	<center><div id="dynamicKinetic"></div></center>
	</div>
	
	<div class="row">
		<center><h3 id="psychologicalascendant">Psychological Ascendant<img src="/images/psychologicalascendant.png" class="title_logo"></h3></center>
	The psychological ascendant depends on (excluding strength and dynamic) the direct confrontations, the number of confrontations, the reputation of the player 
	on the surface (winning rate on this surface), the experience (number of matchs played before and number of time the player reach such a round of a similar 
	competition), and the winning rate at this round of a competition. Computing experiences ratio we end up with a 5 dimensions vector, turned into a 8 dimensions 
	vectors	as usual. Here the elbow method gives a K region around 8-9.
	</div>

	<div class="row">
		<center><h3 id="tiredness">Tiredness<img src="/images/tiredness.jpg" class="title_logo"></h3></center>
	The tiredness is somehow related to the dynamic. In order to have a tiredness variable, instead of computing the number of match/sets played by day in 
	the past, I computed the ratio between this rate in the last period over this rate over the last year. Thus, if a player has played an important number 
	of match in the last period but also during the whole year, we can assume that he is used to it and has a good physical condition thus he is not tired 
	versus some player who has played much more match by day than usual. We then have a 6 dimensions variables ... turned into a 7 as usual. The elbow method 
	gives a K region around 7.
	</div>
	
	<div class="row">
		<center><h3 id="context">Context<img src="/images/context.jpg" class="title_logo"></h3></center>
	I lack a lot of context information... The most significant context I lack of his the weather. But I also lack of a gold information that sportsman not 
	communicate about, that is their physical health. Sometimes we can know about it just looking at him and seeing many straps around the knees, or the 
	help of a kine during the previous match, or knowing that Nadal has an appendicitis ... but those are information I haven't in my database. But what I do 
	have is the odds of the match which I hope has been computed taking those information into account. This winning odd ratio will be my first context variable. 
	The other variables will be a description of the match : Tournament (ATP250/ATP500/Master1000/GS/Masters/Others), Surface. Those description gives me binary 
	vector of dimension 10, so a 11 dimension vector for the context variable and I didn't make any further transformation for this one. The first reason why is 
	that I can't get a better clustering of the surface variable than the binary vector with only one 1. So a clustering won't give me any more informations besides the 
	fact that a given tournament is played on a specific surface. The second reason is that for each tournament and each surface taken has a standalone, exactly 
	half player have won and half player have lost, so there is nothing to gain. So thus binary variables will help later when combined with the others key points. 
	I will nonetheless provide the winning rate histogram given the relative bet variable to check it's effectiveness. 
	</div>
	
	<div class="row">
	<center><h4 id="EMalgorithms">EM algorithm clustering</h4></center>
	For the first four graphs, the abscissa correspond to the number of cluster and the ordered to the winning rate of a cluster. Hover the balloon to see the winning rate 
	and the number of player by cluster. The size of the balloon is proportional to the number of players in it. The bet graph give the winning rate in function of the bet ratio. 
	Thus when the bet ratio is close to 1, to the player have the same level and the winning rate is close to 0.5. When the winning rate is close to 0 (low score / high score), the 
	winning rate is high for the one who has a high score.
	<center><div class="masthead">
	<ul class="nav nav-notjustified">
		<li class="active"><a href="javascript:balloonPlotKinetic('balloonPlotKinetic',700,500,data_strength,20,3,15,'Strength');">Strength</a></li>
		<li><a href="javascript:balloonPlotKinetic('balloonPlotKinetic',700,500,data_dynamic,20,3,10,'Dynamic');">Dynamic</a></li>
		<li><a href="javascript:balloonPlotKinetic('balloonPlotKinetic',700,500,data_psy,20,3,10,'Psy Ascendant');">Psy Ascendant</a></li>
		<li><a href="javascript:balloonPlotKinetic('balloonPlotKinetic',700,500,data_tiredness,20,3,10,'Tiredness');">Tiredness</a></li>
		<li><a href="javascript:areaPlotKinetic('balloonPlotKinetic',680,500,data_bet,'Bet');">Bet</a></li>
	</ul>
		<div id="balloonPlotKinetic"></div>
	</div></center>
	</div>
	
	<div class="row">
	<h3 id="dimReduct" class="sub-header">Features dimensionality reduction</h3>
	In order to take non linear information in the features I chose to perform non linear dimensionality reduction on two possible dataset.
	</br>
	The first one is obtain by pasting every key points in columns so this gives me for each match a vector of length 
	46 = 11<span class="small">(strength)</span>+9<span class="small">(dynamic)+8</span><span class="small">
	(psychological ascendant)</span>+7<span class="small">(tiredness)</span>+11+<span class="small">(context)</span>
	</br>
	The second one is obtain by computing the outer product between all my key points so this gives me for each match a vector of length 
	95 040 = (11+1)<span class="small">(strength)</span>*(9+1)<span class="small">(dynamic)*(8+1)</span><span class="small">
	(psychological ascendant)</span>*(7+1)<span class="small">(tiredness)</span>*(11+1)*<span class="small">(context)</span>. The +1 coming 
	from the fact that I had a constant vector of 1 for each key point to keep in my variable each variable as a standalone. This dataset gave 
	a lot a trouble to manage that many columns !
	</br>
	Then for each dataset, in order to reduce the dimension, I <a target=_blank href="/code/laplacianEigenmap.pgp">implemented</a> the 
	<a target=_blank href="http://www.cs.rochester.edu/~stefanko/Teaching/09CS446/Laplacian.pdf">Laplacian Eigenmap</a> method, which had 
	been presented by Mikhail Belkin and Partha Niyogi. Finally I tried a projection into a subspace of several dimension from 3 to 19,	and performed 
	for each an SVM classifier with different kernel (linear, polynomial and gaussian).
	</div>
	
	<div class="row">
	<h2 id="results" class="sub-header"> Results</h2>
	For each dataset and dimension chose for the dimensionality reduction I performed 5 cross validation learning on a random subset of 80% of the data and testing on 
	the 20% left. Here is the graph of the precision (not the precision-recall, see the remark why) for each dimension. (The precision is the ratio between the true positive and the positive prediction, and 
	the recall is the ratio between the true positive and the total of real positive value). I also did the same for the first dataset without dimensionality reduction to see the 
	impact of the reduction. I can't do it for the second one because the number of variable is far to big for an SVM on my computer !
	</br>
	<strong>Remark</strong> : There can be only one winner ! So there is no decision value to consider. I predict for each player of a match his winning probability. Then I can't
	say "if this probability is greater than x then he won" because I could get two winners or two losers. So if his winning probability is greater than is opponent's 
	then he won. Thus, if I'm right for one of the two players, I'm automatically right for both, and I predict exactly one positive value and one negative value for 
	each match. Consequently the number of positive value is equal to the number of positive prediction and the precision equal the recall equal the F-score.
	</br>
	<strong>Remark 2</strong> : The precision is always greater or equal than 0.5. Indeed, if the precision is lower than 0.5, I choose the opposite strategy which gives me a precision greater than 0.5. 
	When this happen, the reversed parameter of the frame while be set to true.	
	</br>
	</br>
	
	<div class="col-sm-8 col-md-4">
	
	<table class="table">
	<tr><th>Dataset</th><td id="dataset"> - </td></tr>
	<tr><th>Kernel</th><td id="kernel"> - </td></tr>
	<tr><th>Dimension</th><td id="dimension"> - </td></tr>
	<tr><th>Precision</th><td id="precision"> - </td></tr>
	<tr><th>Reversed</th><td id="reverse"> - </td></tr>
	</table>
	
	<table class="table table-bordered" style="text-align:center">
	<tr><th rowspan="2" colspan="2"><center>#</center></th><th colspan="2"><center>Prediction</center></th></tr>
	<tr><th><center>1</center></th><th><center>0</center></th></tr>
	<tr><th rowspan="2"><center>Reality</center><th><center>1</center></th><td id="TP">TP = ?</td><td id="FN">FN = ?</td></tr>
	<tr><th><center>0</center></th><td id="FP">FP = ?</td><td id="TN">TN = ?</td></tr>
	</table>
	
	</div>
	
	<div class="col-sm-8 col-md-8" id="F1output">
	
	</div>
	
	The results being quite good, this confirm the interest of such a methodology. It seems that computing the outer product of the variables has globally a 
	negative impact on the prediction for this model. I'm very surprised by the result with the first dataset in dimension 3. I ran the model several times
	to check it and it gives that good a prediction each time. I'm then going to re-run the model on more data and make a real prediction for the future with 
	this parametrization in an other article and see what happen...
	</div>
	</div>
	
	
          
	</div>
</div>
</body>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script>sidebarAactiveli("/machinelearning/entertainment/tennis.php");</script>
	<script src="/js/crossfilter.v1.min.js"></script>
	<script src="/dc.js-1.7.0/dc.js"></script>
	<script src="/js/function.js"></script>
	<script src="/library/kinetic.js"></script>
	<script src="/js/tennis.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/docs.min.js"></script></body>
</html>
