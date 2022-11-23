<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>
<style>
#overskrift {
background-color: #275E2D;
}
#overskrift h2 {
text-align: left;
padding-top: 30px;
padding-bottom: 30px;
color:white;
text-align: center;
}
h3 {
text-align: left;
padding-left:40px;
padding-top: 10px;
}

hr {
border: 0.5px solid black;
border-radius: 17px;
width: 50px;
margin-left: 40px;
height:0px;

}
#filtrering {
text-align:left;
display:flex;
flex-flow:column;
place-items: start;
padding-left:40px;

}
button:hover {
color:orange;
}
button {
background-color: white;
border: 1px solid white;
color: #275E2D;
margin-right:15px;
  font-family: futura-pt, sans-serif;
  font-weight: 400;
  font-style: normal;
}

.teams-container {
display: grid;
grid-template-columns: repeat(2, 1fr);
gap: 0.8em;
padding: 35px 180px 100px 180px;
cursor: pointer;
margin-top:-195px;
}

article {
background-color: white;   
cursor: pointer;
position: relative;
text-align: center;
color: white;
grid-area: 1/1;
      }

article:hover {
color:green;
z-index: 300;
}

.overlay {
background-color: rgba(0,0,0,0.7);
z-index: 100;
grid-area: 1/1;
}

/* tekst placeret i venstre side */
h5 {
position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color:white;
  font-size: 50px;
z-index: 200;
}
img {
max-width: 100%;
object-fit: contain;
}
.article-container {
display: grid;
}

@media (max-width: 950px) {
h5 {
	font-size:3rem;
}}
@media (max-width: 750px) {
.teams-container {
display: grid;
grid-template-columns: 1fr;
padding: 10px 20px 10px 20px;
}
#filtrering {
text-align:left;
display:flex;
flex-flow:row;
place-items: start;
padding-left:20px;
}
.teams-container {
margin-top:-0px;
}
h5 {
  font-size: 60px;
}
h3 {
padding-left:20px;
}
hr {
margin-left: 20px;
}
button {
margin-right:5px;
}
}
</style>

<section id="primary" class="content-area">
<main id="site-content">
<section id="overskrift">
<h2>Fodbold hold</h2>
</section>
<h3>FILTRER</h3>
<hr>
<nav id="filtrering"><button data-team="alle">Alle</button></nav>
<section class="teams-container"></section>
</main><!-- #site-content -->
<template class="teams-template">
	<div class="article-container">
	<article>
	<img src="" alt="">
	<h5></h5>
	</article>
	<div class ="overlay"></div>
	</div>
</template>

<script>
let teams = [];
let categories = [];
const liste = document.querySelector(".teams-container");
const template = document.querySelector(".teams-template");
let filterTeams = "alle";
document.addEventListener("DOMContentLoaded", start);

function start() {
	getJson();
} 

// find url til json
const url = "https://www.struckmanndesign.dk/kea/09_cms/nrb-site/wp-json/wp/v2/team?per_page=100";
const catUrl = "https://www.struckmanndesign.dk/kea/09_cms/nrb-site/wp-json/wp/v2/categories"

// hent json
async function getJson() {
	let response = await fetch(url);
	let catResponse = await fetch(catUrl);
	// putter dem ind i en variabel -> får det vist som json
	teams = await response.json();
	// ændrer rækkefølgen på kategorier
	teams.reverse();
	categories = await catResponse.json();
	console.log(categories);
	// kald funktion
	visTeams();
	opretKnapper();
}

function opretKnapper() {
categories.forEach(cat =>{
document.querySelector("#filtrering").innerHTML += `<button class="filter" data-team="${cat.id}">${cat.name}</button>`
	})
addEventListenersToButtons();
}
function addEventListenersToButtons(){
	document.querySelectorAll("#filtrering button").forEach(elm =>{
		elm.addEventListener("click", filtrering);
	})
}

function filtrering(){
	filterTeams = this.dataset.team;
	console.log("KNAP EVT",filterTeams)
	visTeams();
}

function visTeams() {
	liste.innerHTML = "";
	teams.forEach(team => {
	if (filterTeams == "alle" || team.categories.includes(parseInt(filterTeams))){
	const klon = template.cloneNode(true).content;
	klon.querySelector("img").src = team.billede.guid;
	klon.querySelector("h5").innerHTML = team.title.rendered;
	klon.querySelector("article").addEventListener("click", ()=> {location.href = team.link})
	liste.appendChild(klon);
	}
	})
}

</script>
</section>
<?php get_footer(); ?>
