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
article {
padding-left: 400px;
padding-right: 400px;
}
img {
max-width: 100%;
/* aspect-ratio: 1/1; */
object-fit: contain;
}
button {
background-color: #d67b21;
  display: flex;
margin-left: 400px;
}
section.teams-container{
	/* padding-top:-100px; */
}

	</style>
<section id="primary" class="content-area">
<main id="site-content">

<section class="teams-container"></section>
</main><!-- #site-content -->
	<article>
	<img src="" alt="">
	<h5></h5>
	<p></p>
	</article>
	<button class="luk">Tilbage</button>
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
}
document.querySelector(".luk").addEventListener("click", () => {
	// link tilbage til den foregående side på luk knappen
	history.back();
})

</script>

<?php get_footer(); ?>
