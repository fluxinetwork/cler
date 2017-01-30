<div class="l-card-slider">
	<aside class="l-card-slider__aside">
		<div class="l-card-slider__aside__title">
			<span class="c-section-title">Gérer vos publications</span>
		</div>
	</aside>

	<div class="l-card-slider__cards">
		<ul class="l-card-slider__cards__row">
			<li class="l-card-slider__cards__row__col">
				<a href="#"><?php include('card.php'); ?></a>
			</li>
			<li class="l-card-slider__cards__row__col u-show@med">
				<a href="https://cler.org/dev-cler/outils/publiez-vos-offres-demploi/" class="cockpit-add">
					<button class="c-btn c-btn--add"></button>
					<span class="c-link c-link--white">offre d'emploi</span>
					<span class="t-meta t-meta--white pdTop--s"><?php ($adherent) ? print('') : print('Payant'); ?></span>
				</a>
			</li>
			<li class="l-card-slider__cards__row__col u-show@med">
				<a href="https://cler.org/dev-cler/mon-profil/gerer-evenement/?act=add" class="cockpit-add">
					<button class="c-btn c-btn--add"></button>
					<span class="c-link c-link--white">évènement</span>
					<span class="t-meta t-meta--white pdTop--s">Gratuit</span>
				</a>
			</li>
			<li class="l-card-slider__cards__row__col u-show@med">
				<a href="https://cler.org/dev-cler/mon-profil/gerer-formations/?act=add" class="cockpit-add">
					<button class="c-btn c-btn--add"></button>
					<span class="c-link c-link--white">formation</span>
					<span class="t-meta t-meta--white pdTop--s">Gratuit</span>
				</a>
			</li>
			
		</ul>
	</div>

	<div class="l-card-slider__controls">
		<button class="c-btnArrow"></button>
		<button class="c-btnArrow c-btnArrow--right"></button>
	</div>
</div>