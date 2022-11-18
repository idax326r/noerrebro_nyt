<?php
/**
 * The template for displaying all pages, single posts and attachments
 *
 * This is a new template file that WordPress introduced in
 * version 4.3.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>
<style>
h5{
	padding-top:50px;
font-size: 2rem;
}

button {
background-color: #275E2D;
border: 2px solid #275E2D;
color: white;
padding:5px 15px 5px 15px;
  text-transform: uppercase;
  font-family: futura-pt-condensed, sans-serif;
  font-weight: 700;
  font-style: italic;
}

article {
/* padding-left: 100px;
padding-right: 100px; */
}
img {
max-width: 100%;
/* aspect-ratio: 1/1; */
object-fit: contain;
margin-bottom:20px;
}
.luk {
	/* background-color: #275E2D;
	border: 2px solid #275E2D;
	color: white;
margin:15px;
padding:5px 15px 5px 15px;
margin-left: 100px; */

	background-color: white;
	border: 1px solid white;
	color: #275E2D;
padding-left:100px;
}
section.teams-container{
	/* padding-top:-100px; */
}

.grid-container {
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap:15px;
	padding-left: 100px;
}
#overskrift {
	background-color: #275E2D;
}
#overskrift h5 {
	text-align: left;
	padding-top: 37px;
text-align:center;
	padding-bottom: 37px;
	color:white;
	  font-size: 35px;
}

@media (max-width: 750px) {
.grid-container {
	display: grid;
	grid-template-columns: 1fr;
	gap:15px;
	padding: 25px;
}
.luk {
	margin-left: 5px;
	padding-left:15px;
}
}
	</style>
<section id="primary" class="content-area">
<main id="site-content">

<section class="teams-container"></section>
</main><!-- #site-content -->
	<article>

<section id="overskrift">
<h5></h5>
</section>
	<button class="luk">Tilbage</button>
	<div class="grid-container">
	<div class="grid-item-1">
	<img src="" alt=""></div>
		<div class="grid-item-2">
	<h3>Træningsinformation</h3>
	<p></p>
	<h3>Træningstider</h3>
		<p></p>
	<p></p>
	<p></p>
	<p></p>
	<button>Tilmeld dig</button>
	</div>
	</div>
	</article>
	</section>
<script>
let team;

document.addEventListener("DOMContentLoaded", getJson);

async function getJson() {
	let response = await fetch(`https://www.struckmanndesign.dk/kea/09_cms/nrb-site/wp-json/wp/v2/team/<?php echo get_the_ID() ?>`);
	team = await response.json();
	visTeam();
} 

// vis data om team
function visTeam() {
const single = document.querySelector("article");
	single.querySelector("h5").innerHTML = team.title.rendered;
	single.querySelector("img").src = team.billede.guid;
	single.querySelector("p").innerHTML = team.hold_information;
	single.querySelector("p+p").innerHTML = "Træningsdag: "+team.traening_dag;
	single.querySelector("p+p+p").innerHTML = "Klokken: "+ team.traening_klokkeslaet;
	single.querySelector("p+p+p+p").innerHTML = "Lokation: "+ team.traening_bane;
}
document.querySelector(".luk").addEventListener("click", () => {
	// link tilbage til den foregående side på luk knappen
	history.back();
})

</script>
<?php get_footer(); ?>
