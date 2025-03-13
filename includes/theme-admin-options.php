<?php
/**
 * Theme options
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 4.0.3
 */

// Load text domain for translation.
load_theme_textdomain( 'newsplus', get_template_directory() . '/languages' );
if ( ! function_exists( 'newsplus_google_font_list' ) ) :
	function newsplus_google_font_list() {
		return apply_filters( 'newsplus_google_font_arr',
				array(
					__( '-- Select --', 'newsplus' ) => '',
					'ABeeZee' => 'ABeeZee:regular,italic',
					'Abel' => 'Abel:regular',
					'Abhaya Libre' => 'Abhaya Libre:regular,500,600,700,800',
					'Abril Fatface' => 'Abril Fatface:regular',
					'Aclonica' => 'Aclonica:regular',
					'Acme' => 'Acme:regular',
					'Actor' => 'Actor:regular',
					'Adamina' => 'Adamina:regular',
					'Advent Pro' => 'Advent Pro:100,200,300,regular,500,600,700',
					'Aguafina Script' => 'Aguafina Script:regular',
					'Akronim' => 'Akronim:regular',
					'Aladin' => 'Aladin:regular',
					'Aldrich' => 'Aldrich:regular',
					'Alef' => 'Alef:regular,700',
					'Alegreya' => 'Alegreya:regular,italic,700,700italic,900,900italic',
					'Alegreya SC' => 'Alegreya SC:regular,italic,700,700italic,900,900italic',
					'Alegreya Sans' => 'Alegreya Sans:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,800,800italic,900,900italic',
					'Alegreya Sans SC' => 'Alegreya Sans SC:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,800,800italic,900,900italic',
					'Alex Brush' => 'Alex Brush:regular',
					'Alfa Slab One' => 'Alfa Slab One:regular',
					'Alice' => 'Alice:regular',
					'Alike' => 'Alike:regular',
					'Alike Angular' => 'Alike Angular:regular',
					'Allan' => 'Allan:regular,700',
					'Allerta' => 'Allerta:regular',
					'Allerta Stencil' => 'Allerta Stencil:regular',
					'Allura' => 'Allura:regular',
					'Almendra' => 'Almendra:regular,italic,700,700italic',
					'Almendra Display' => 'Almendra Display:regular',
					'Almendra SC' => 'Almendra SC:regular',
					'Amarante' => 'Amarante:regular',
					'Amaranth' => 'Amaranth:regular,italic,700,700italic',
					'Amatic SC' => 'Amatic SC:regular,700',
					'Amatica SC' => 'Amatica SC:regular,700',
					'Amethysta' => 'Amethysta:regular',
					'Amiko' => 'Amiko:regular,600,700',
					'Amiri' => 'Amiri:regular,italic,700,700italic',
					'Amita' => 'Amita:regular,700',
					'Anaheim' => 'Anaheim:regular',
					'Andada' => 'Andada:regular',
					'Andika' => 'Andika:regular',
					'Angkor' => 'Angkor:regular',
					'Annie Use Your Telescope' => 'Annie Use Your Telescope:regular',
					'Anonymous Pro' => 'Anonymous Pro:regular,italic,700,700italic',
					'Antic' => 'Antic:regular',
					'Antic Didone' => 'Antic Didone:regular',
					'Antic Slab' => 'Antic Slab:regular',
					'Anton' => 'Anton:regular',
					'Arapey' => 'Arapey:regular,italic',
					'Arbutus' => 'Arbutus:regular',
					'Arbutus Slab' => 'Arbutus Slab:regular',
					'Architects Daughter' => 'Architects Daughter:regular',
					'Archivo Black' => 'Archivo Black:regular',
					'Archivo Narrow' => 'Archivo Narrow:regular,italic,700,700italic',
					'Aref Ruqaa' => 'Aref Ruqaa:regular,700',
					'Arima Madurai' => 'Arima Madurai:100,200,300,regular,500,700,800,900',
					'Arimo' => 'Arimo:regular,italic,700,700italic',
					'Arizonia' => 'Arizonia:regular',
					'Armata' => 'Armata:regular',
					'Arsenal' => 'Arsenal:regular,italic,700,700italic',
					'Artifika' => 'Artifika:regular',
					'Arvo' => 'Arvo:regular,italic,700,700italic',
					'Arya' => 'Arya:regular,700',
					'Asap' => 'Asap:regular,italic,500,500italic,700,700italic',
					'Asar' => 'Asar:regular',
					'Asset' => 'Asset:regular',
					'Assistant' => 'Assistant:200,300,regular,600,700,800',
					'Astloch' => 'Astloch:regular,700',
					'Asul' => 'Asul:regular,700',
					'Athiti' => 'Athiti:200,300,regular,500,600,700',
					'Atma' => 'Atma:300,regular,500,600,700',
					'Atomic Age' => 'Atomic Age:regular',
					'Aubrey' => 'Aubrey:regular',
					'Audiowide' => 'Audiowide:regular',
					'Autour One' => 'Autour One:regular',
					'Average' => 'Average:regular',
					'Average Sans' => 'Average Sans:regular',
					'Averia Gruesa Libre' => 'Averia Gruesa Libre:regular',
					'Averia Libre' => 'Averia Libre:300,300italic,regular,italic,700,700italic',
					'Averia Sans Libre' => 'Averia Sans Libre:300,300italic,regular,italic,700,700italic',
					'Averia Serif Libre' => 'Averia Serif Libre:300,300italic,regular,italic,700,700italic',
					'Bad Script' => 'Bad Script:regular',
					'Bahiana' => 'Bahiana:regular',
					'Baloo' => 'Baloo:regular',
					'Baloo Bhai' => 'Baloo Bhai:regular',
					'Baloo Bhaina' => 'Baloo Bhaina:regular',
					'Baloo Chettan' => 'Baloo Chettan:regular',
					'Baloo Da' => 'Baloo Da:regular',
					'Baloo Paaji' => 'Baloo Paaji:regular',
					'Baloo Tamma' => 'Baloo Tamma:regular',
					'Baloo Thambi' => 'Baloo Thambi:regular',
					'Balthazar' => 'Balthazar:regular',
					'Bangers' => 'Bangers:regular',
					'Barrio' => 'Barrio:regular',
					'Basic' => 'Basic:regular',
					'Battambang' => 'Battambang:regular,700',
					'Baumans' => 'Baumans:regular',
					'Bayon' => 'Bayon:regular',
					'Belgrano' => 'Belgrano:regular',
					'Bellefair' => 'Bellefair:regular',
					'Belleza' => 'Belleza:regular',
					'BenchNine' => 'BenchNine:300,regular,700',
					'Bentham' => 'Bentham:regular',
					'Berkshire Swash' => 'Berkshire Swash:regular',
					'Bevan' => 'Bevan:regular',
					'Bigelow Rules' => 'Bigelow Rules:regular',
					'Bigshot One' => 'Bigshot One:regular',
					'Bilbo' => 'Bilbo:regular',
					'Bilbo Swash Caps' => 'Bilbo Swash Caps:regular',
					'BioRhyme' => 'BioRhyme:200,300,regular,700,800',
					'BioRhyme Expanded' => 'BioRhyme Expanded:200,300,regular,700,800',
					'Biryani' => 'Biryani:200,300,regular,600,700,800,900',
					'Bitter' => 'Bitter:regular,italic,700',
					'Black Ops One' => 'Black Ops One:regular',
					'Bokor' => 'Bokor:regular',
					'Bonbon' => 'Bonbon:regular',
					'Boogaloo' => 'Boogaloo:regular',
					'Bowlby One' => 'Bowlby One:regular',
					'Bowlby One SC' => 'Bowlby One SC:regular',
					'Brawler' => 'Brawler:regular',
					'Bree Serif' => 'Bree Serif:regular',
					'Bubblegum Sans' => 'Bubblegum Sans:regular',
					'Bubbler One' => 'Bubbler One:regular',
					'Buda' => 'Buda:300',
					'Buenard' => 'Buenard:regular,700',
					'Bungee' => 'Bungee:regular',
					'Bungee Hairline' => 'Bungee Hairline:regular',
					'Bungee Inline' => 'Bungee Inline:regular',
					'Bungee Outline' => 'Bungee Outline:regular',
					'Bungee Shade' => 'Bungee Shade:regular',
					'Butcherman' => 'Butcherman:regular',
					'Butterfly Kids' => 'Butterfly Kids:regular',
					'Cabin' => 'Cabin:regular,italic,500,500italic,600,600italic,700,700italic',
					'Cabin Condensed' => 'Cabin Condensed:regular,500,600,700',
					'Cabin Sketch' => 'Cabin Sketch:regular,700',
					'Caesar Dressing' => 'Caesar Dressing:regular',
					'Cagliostro' => 'Cagliostro:regular',
					'Cairo' => 'Cairo:200,300,regular,600,700,900',
					'Calligraffitti' => 'Calligraffitti:regular',
					'Cambay' => 'Cambay:regular,italic,700,700italic',
					'Cambo' => 'Cambo:regular',
					'Candal' => 'Candal:regular',
					'Cantarell' => 'Cantarell:regular,italic,700,700italic',
					'Cantata One' => 'Cantata One:regular',
					'Cantora One' => 'Cantora One:regular',
					'Capriola' => 'Capriola:regular',
					'Cardo' => 'Cardo:regular,italic,700',
					'Carme' => 'Carme:regular',
					'Carrois Gothic' => 'Carrois Gothic:regular',
					'Carrois Gothic SC' => 'Carrois Gothic SC:regular',
					'Carter One' => 'Carter One:regular',
					'Catamaran' => 'Catamaran:100,200,300,regular,500,600,700,800,900',
					'Caudex' => 'Caudex:regular,italic,700,700italic',
					'Caveat' => 'Caveat:regular,700',
					'Caveat Brush' => 'Caveat Brush:regular',
					'Cedarville Cursive' => 'Cedarville Cursive:regular',
					'Ceviche One' => 'Ceviche One:regular',
					'Changa' => 'Changa:200,300,regular,500,600,700,800',
					'Changa One' => 'Changa One:regular,italic',
					'Chango' => 'Chango:regular',
					'Chathura' => 'Chathura:100,300,regular,700,800',
					'Chau Philomene One' => 'Chau Philomene One:regular,italic',
					'Chela One' => 'Chela One:regular',
					'Chelsea Market' => 'Chelsea Market:regular',
					'Chenla' => 'Chenla:regular',
					'Cherry Cream Soda' => 'Cherry Cream Soda:regular',
					'Cherry Swash' => 'Cherry Swash:regular,700',
					'Chewy' => 'Chewy:regular',
					'Chicle' => 'Chicle:regular',
					'Chivo' => 'Chivo:300,300italic,regular,italic,700,700italic,900,900italic',
					'Chonburi' => 'Chonburi:regular',
					'Cinzel' => 'Cinzel:regular,700,900',
					'Cinzel Decorative' => 'Cinzel Decorative:regular,700,900',
					'Clicker Script' => 'Clicker Script:regular',
					'Coda' => 'Coda:regular,800',
					'Coda Caption' => 'Coda Caption:800',
					'Codystar' => 'Codystar:300,regular',
					'Coiny' => 'Coiny:regular',
					'Combo' => 'Combo:regular',
					'Comfortaa' => 'Comfortaa:300,regular,700',
					'Coming Soon' => 'Coming Soon:regular',
					'Concert One' => 'Concert One:regular',
					'Condiment' => 'Condiment:regular',
					'Content' => 'Content:regular,700',
					'Contrail One' => 'Contrail One:regular',
					'Convergence' => 'Convergence:regular',
					'Cookie' => 'Cookie:regular',
					'Copse' => 'Copse:regular',
					'Corben' => 'Corben:regular,700',
					'Cormorant' => 'Cormorant:300,300italic,regular,italic,500,500italic,600,600italic,700,700italic',
					'Cormorant Garamond' => 'Cormorant Garamond:300,300italic,regular,italic,500,500italic,600,600italic,700,700italic',
					'Cormorant Infant' => 'Cormorant Infant:300,300italic,regular,italic,500,500italic,600,600italic,700,700italic',
					'Cormorant SC' => 'Cormorant SC:300,regular,500,600,700',
					'Cormorant Unicase' => 'Cormorant Unicase:300,regular,500,600,700',
					'Cormorant Upright' => 'Cormorant Upright:300,regular,500,600,700',
					'Courgette' => 'Courgette:regular',
					'Cousine' => 'Cousine:regular,italic,700,700italic',
					'Coustard' => 'Coustard:regular,900',
					'Covered By Your Grace' => 'Covered By Your Grace:regular',
					'Crafty Girls' => 'Crafty Girls:regular',
					'Creepster' => 'Creepster:regular',
					'Crete Round' => 'Crete Round:regular,italic',
					'Crimson Text' => 'Crimson Text:regular,italic,600,600italic,700,700italic',
					'Croissant One' => 'Croissant One:regular',
					'Crushed' => 'Crushed:regular',
					'Cuprum' => 'Cuprum:regular,italic,700,700italic',
					'Cutive' => 'Cutive:regular',
					'Cutive Mono' => 'Cutive Mono:regular',
					'Damion' => 'Damion:regular',
					'Dancing Script' => 'Dancing Script:regular,700',
					'Dangrek' => 'Dangrek:regular',
					'David Libre' => 'David Libre:regular,500,700',
					'Dawning of a New Day' => 'Dawning of a New Day:regular',
					'Days One' => 'Days One:regular',
					'Dekko' => 'Dekko:regular',
					'Delius' => 'Delius:regular',
					'Delius Swash Caps' => 'Delius Swash Caps:regular',
					'Delius Unicase' => 'Delius Unicase:regular,700',
					'Della Respira' => 'Della Respira:regular',
					'Denk One' => 'Denk One:regular',
					'Devonshire' => 'Devonshire:regular',
					'Dhurjati' => 'Dhurjati:regular',
					'Didact Gothic' => 'Didact Gothic:regular',
					'Diplomata' => 'Diplomata:regular',
					'Diplomata SC' => 'Diplomata SC:regular',
					'Domine' => 'Domine:regular,700',
					'Donegal One' => 'Donegal One:regular',
					'Doppio One' => 'Doppio One:regular',
					'Dorsa' => 'Dorsa:regular',
					'Dosis' => 'Dosis:200,300,regular,500,600,700,800',
					'Dr Sugiyama' => 'Dr Sugiyama:regular',
					'Droid Sans' => 'Droid Sans:regular,700',
					'Droid Sans Mono' => 'Droid Sans Mono:regular',
					'Droid Serif' => 'Droid Serif:regular,italic,700,700italic',
					'Duru Sans' => 'Duru Sans:regular',
					'Dynalight' => 'Dynalight:regular',
					'EB Garamond' => 'EB Garamond:regular',
					'Eagle Lake' => 'Eagle Lake:regular',
					'Eater' => 'Eater:regular',
					'Economica' => 'Economica:regular,italic,700,700italic',
					'Eczar' => 'Eczar:regular,500,600,700,800',
					'Ek Mukta' => 'Ek Mukta:200,300,regular,500,600,700,800',
					'El Messiri' => 'El Messiri:regular,500,600,700',
					'Electrolize' => 'Electrolize:regular',
					'Elsie' => 'Elsie:regular,900',
					'Elsie Swash Caps' => 'Elsie Swash Caps:regular,900',
					'Emblema One' => 'Emblema One:regular',
					'Emilys Candy' => 'Emilys Candy:regular',
					'Engagement' => 'Engagement:regular',
					'Englebert' => 'Englebert:regular',
					'Enriqueta' => 'Enriqueta:regular,700',
					'Erica One' => 'Erica One:regular',
					'Esteban' => 'Esteban:regular',
					'Euphoria Script' => 'Euphoria Script:regular',
					'Ewert' => 'Ewert:regular',
					'Exo' => 'Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Exo 2' => 'Exo 2:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Expletus Sans' => 'Expletus Sans:regular,italic,500,500italic,600,600italic,700,700italic',
					'Fanwood Text' => 'Fanwood Text:regular,italic',
					'Farsan' => 'Farsan:regular',
					'Fascinate' => 'Fascinate:regular',
					'Fascinate Inline' => 'Fascinate Inline:regular',
					'Faster One' => 'Faster One:regular',
					'Fasthand' => 'Fasthand:regular',
					'Fauna One' => 'Fauna One:regular',
					'Federant' => 'Federant:regular',
					'Federo' => 'Federo:regular',
					'Felipa' => 'Felipa:regular',
					'Fenix' => 'Fenix:regular',
					'Finger Paint' => 'Finger Paint:regular',
					'Fira Mono' => 'Fira Mono:regular,500,700',
					'Fira Sans' => 'Fira Sans:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Fira Sans Condensed' => 'Fira Sans Condensed:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Fira Sans Extra Condensed' => 'Fira Sans Extra Condensed:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Fjalla One' => 'Fjalla One:regular',
					'Fjord One' => 'Fjord One:regular',
					'Flamenco' => 'Flamenco:300,regular',
					'Flavors' => 'Flavors:regular',
					'Fondamento' => 'Fondamento:regular,italic',
					'Fontdiner Swanky' => 'Fontdiner Swanky:regular',
					'Forum' => 'Forum:regular',
					'Francois One' => 'Francois One:regular',
					'Frank Ruhl Libre' => 'Frank Ruhl Libre:300,regular,500,700,900',
					'Freckle Face' => 'Freckle Face:regular',
					'Fredericka the Great' => 'Fredericka the Great:regular',
					'Fredoka One' => 'Fredoka One:regular',
					'Freehand' => 'Freehand:regular',
					'Fresca' => 'Fresca:regular',
					'Frijole' => 'Frijole:regular',
					'Fruktur' => 'Fruktur:regular',
					'Fugaz One' => 'Fugaz One:regular',
					'GFS Didot' => 'GFS Didot:regular',
					'GFS Neohellenic' => 'GFS Neohellenic:regular,italic,700,700italic',
					'Gabriela' => 'Gabriela:regular',
					'Gafata' => 'Gafata:regular',
					'Galada' => 'Galada:regular',
					'Galdeano' => 'Galdeano:regular',
					'Galindo' => 'Galindo:regular',
					'Gentium Basic' => 'Gentium Basic:regular,italic,700,700italic',
					'Gentium Book Basic' => 'Gentium Book Basic:regular,italic,700,700italic',
					'Geo' => 'Geo:regular,italic',
					'Geostar' => 'Geostar:regular',
					'Geostar Fill' => 'Geostar Fill:regular',
					'Germania One' => 'Germania One:regular',
					'Gidugu' => 'Gidugu:regular',
					'Gilda Display' => 'Gilda Display:regular',
					'Give You Glory' => 'Give You Glory:regular',
					'Glass Antiqua' => 'Glass Antiqua:regular',
					'Glegoo' => 'Glegoo:regular,700',
					'Gloria Hallelujah' => 'Gloria Hallelujah:regular',
					'Goblin One' => 'Goblin One:regular',
					'Gochi Hand' => 'Gochi Hand:regular',
					'Gorditas' => 'Gorditas:regular,700',
					'Goudy Bookletter 1911' => 'Goudy Bookletter 1911:regular',
					'Graduate' => 'Graduate:regular',
					'Grand Hotel' => 'Grand Hotel:regular',
					'Gravitas One' => 'Gravitas One:regular',
					'Great Vibes' => 'Great Vibes:regular',
					'Griffy' => 'Griffy:regular',
					'Gruppo' => 'Gruppo:regular',
					'Gudea' => 'Gudea:regular,italic,700',
					'Gurajada' => 'Gurajada:regular',
					'Habibi' => 'Habibi:regular',
					'Halant' => 'Halant:300,regular,500,600,700',
					'Hammersmith One' => 'Hammersmith One:regular',
					'Hanalei' => 'Hanalei:regular',
					'Hanalei Fill' => 'Hanalei Fill:regular',
					'Handlee' => 'Handlee:regular',
					'Hanuman' => 'Hanuman:regular,700',
					'Happy Monkey' => 'Happy Monkey:regular',
					'Harmattan' => 'Harmattan:regular',
					'Headland One' => 'Headland One:regular',
					'Heebo' => 'Heebo:100,300,regular,500,700,800,900',
					'Henny Penny' => 'Henny Penny:regular',
					'Herr Von Muellerhoff' => 'Herr Von Muellerhoff:regular',
					'Hind' => 'Hind:300,regular,500,600,700',
					'Hind Guntur' => 'Hind Guntur:300,regular,500,600,700',
					'Hind Madurai' => 'Hind Madurai:300,regular,500,600,700',
					'Hind Siliguri' => 'Hind Siliguri:300,regular,500,600,700',
					'Hind Vadodara' => 'Hind Vadodara:300,regular,500,600,700',
					'Holtwood One SC' => 'Holtwood One SC:regular',
					'Homemade Apple' => 'Homemade Apple:regular',
					'Homenaje' => 'Homenaje:regular',
					'IM Fell DW Pica' => 'IM Fell DW Pica:regular,italic',
					'IM Fell DW Pica SC' => 'IM Fell DW Pica SC:regular',
					'IM Fell Double Pica' => 'IM Fell Double Pica:regular,italic',
					'IM Fell Double Pica SC' => 'IM Fell Double Pica SC:regular',
					'IM Fell English' => 'IM Fell English:regular,italic',
					'IM Fell English SC' => 'IM Fell English SC:regular',
					'IM Fell French Canon' => 'IM Fell French Canon:regular,italic',
					'IM Fell French Canon SC' => 'IM Fell French Canon SC:regular',
					'IM Fell Great Primer' => 'IM Fell Great Primer:regular,italic',
					'IM Fell Great Primer SC' => 'IM Fell Great Primer SC:regular',
					'Iceberg' => 'Iceberg:regular',
					'Iceland' => 'Iceland:regular',
					'Imprima' => 'Imprima:regular',

					'Inconsolata' => 'Inconsolata:regular,700',
					'Inder' => 'Inder:regular',
					'Indie Flower' => 'Indie Flower:regular',
					'Inika' => 'Inika:regular,700',
					'Inknut Antiqua' => 'Inknut Antiqua:300,regular,500,600,700,800,900',
					'Irish Grover' => 'Irish Grover:regular',
					'Istok Web' => 'Istok Web:regular,italic,700,700italic',
					'Italiana' => 'Italiana:regular',
					'Italianno' => 'Italianno:regular',
					'Itim' => 'Itim:regular',
					'Jacques Francois' => 'Jacques Francois:regular',
					'Jacques Francois Shadow' => 'Jacques Francois Shadow:regular',
					'Jaldi' => 'Jaldi:regular,700',
					'Jim Nightshade' => 'Jim Nightshade:regular',
					'Jockey One' => 'Jockey One:regular',
					'Jolly Lodger' => 'Jolly Lodger:regular',
					'Jomhuria' => 'Jomhuria:regular',
					'Josefin Sans' => 'Josefin Sans:100,100italic,300,300italic,regular,italic,600,600italic,700,700italic',
					'Josefin Slab' => 'Josefin Slab:100,100italic,300,300italic,regular,italic,600,600italic,700,700italic',
					'Joti One' => 'Joti One:regular',
					'Judson' => 'Judson:regular,italic,700',
					'Julee' => 'Julee:regular',
					'Julius Sans One' => 'Julius Sans One:regular',
					'Junge' => 'Junge:regular',
					'Jura' => 'Jura:300,regular,500,600,700',
					'Just Another Hand' => 'Just Another Hand:regular',
					'Just Me Again Down Here' => 'Just Me Again Down Here:regular',
					'Kadwa' => 'Kadwa:regular,700',
					'Kalam' => 'Kalam:300,regular,700',
					'Kameron' => 'Kameron:regular,700',
					'Kanit' => 'Kanit:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Kantumruy' => 'Kantumruy:300,regular,700',
					'Karla' => 'Karla:regular,italic,700,700italic',
					'Karma' => 'Karma:300,regular,500,600,700',
					'Katibeh' => 'Katibeh:regular',
					'Kaushan Script' => 'Kaushan Script:regular',
					'Kavivanar' => 'Kavivanar:regular',
					'Kavoon' => 'Kavoon:regular',
					'Kdam Thmor' => 'Kdam Thmor:regular',
					'Keania One' => 'Keania One:regular',
					'Kelly Slab' => 'Kelly Slab:regular',
					'Kenia' => 'Kenia:regular',
					'Khand' => 'Khand:300,regular,500,600,700',
					'Khmer' => 'Khmer:regular',
					'Khula' => 'Khula:300,regular,600,700,800',
					'Kite One' => 'Kite One:regular',
					'Knewave' => 'Knewave:regular',
					'Kotta One' => 'Kotta One:regular',
					'Koulen' => 'Koulen:regular',
					'Kranky' => 'Kranky:regular',
					'Kreon' => 'Kreon:300,regular,700',
					'Kristi' => 'Kristi:regular',
					'Krona One' => 'Krona One:regular',
					'Kumar One' => 'Kumar One:regular',
					'Kumar One Outline' => 'Kumar One Outline:regular',
					'Kurale' => 'Kurale:regular',
					'La Belle Aurore' => 'La Belle Aurore:regular',
					'Laila' => 'Laila:300,regular,500,600,700',
					'Lakki Reddy' => 'Lakki Reddy:regular',
					'Lalezar' => 'Lalezar:regular',
					'Lancelot' => 'Lancelot:regular',
					'Lateef' => 'Lateef:regular',
					'Lato' => 'Lato:100,100italic,300,300italic,regular,italic,700,700italic,900,900italic',
					'League Script' => 'League Script:regular',
					'Leckerli One' => 'Leckerli One:regular',
					'Ledger' => 'Ledger:regular',
					'Lekton' => 'Lekton:regular,italic,700',
					'Lemon' => 'Lemon:regular',
					'Lemonada' => 'Lemonada:300,regular,600,700',
					'Libre Baskerville' => 'Libre Baskerville:regular,italic,700',
					'Libre Franklin' => 'Libre Franklin:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Life Savers' => 'Life Savers:regular,700',
					'Lilita One' => 'Lilita One:regular',
					'Lily Script One' => 'Lily Script One:regular',
					'Limelight' => 'Limelight:regular',
					'Linden Hill' => 'Linden Hill:regular,italic',
					'Lobster' => 'Lobster:regular',
					'Lobster Two' => 'Lobster Two:regular,italic,700,700italic',
					'Londrina Outline' => 'Londrina Outline:regular',
					'Londrina Shadow' => 'Londrina Shadow:regular',
					'Londrina Sketch' => 'Londrina Sketch:regular',
					'Londrina Solid' => 'Londrina Solid:regular',
					'Lora' => 'Lora:regular,italic,700,700italic',
					'Love Ya Like A Sister' => 'Love Ya Like A Sister:regular',
					'Loved by the King' => 'Loved by the King:regular',
					'Lovers Quarrel' => 'Lovers Quarrel:regular',
					'Luckiest Guy' => 'Luckiest Guy:regular',
					'Lusitana' => 'Lusitana:regular,700',
					'Lustria' => 'Lustria:regular',
					'Macondo' => 'Macondo:regular',
					'Macondo Swash Caps' => 'Macondo Swash Caps:regular',
					'Mada' => 'Mada:300,regular,500,900',
					'Magra' => 'Magra:regular,700',
					'Maiden Orange' => 'Maiden Orange:regular',
					'Maitree' => 'Maitree:200,300,regular,500,600,700',
					'Mako' => 'Mako:regular',
					'Mallanna' => 'Mallanna:regular',
					'Mandali' => 'Mandali:regular',
					'Marcellus' => 'Marcellus:regular',
					'Marcellus SC' => 'Marcellus SC:regular',
					'Marck Script' => 'Marck Script:regular',
					'Margarine' => 'Margarine:regular',
					'Marko One' => 'Marko One:regular',
					'Marmelad' => 'Marmelad:regular',
					'Martel' => 'Martel:200,300,regular,600,700,800,900',
					'Martel Sans' => 'Martel Sans:200,300,regular,600,700,800,900',
					'Marvel' => 'Marvel:regular,italic,700,700italic',
					'Mate' => 'Mate:regular,italic',
					'Mate SC' => 'Mate SC:regular',
					'Maven Pro' => 'Maven Pro:regular,500,700,900',
					'McLaren' => 'McLaren:regular',
					'Meddon' => 'Meddon:regular',
					'MedievalSharp' => 'MedievalSharp:regular',
					'Medula One' => 'Medula One:regular',
					'Meera Inimai' => 'Meera Inimai:regular',
					'Megrim' => 'Megrim:regular',
					'Meie Script' => 'Meie Script:regular',
					'Merienda' => 'Merienda:regular,700',
					'Merienda One' => 'Merienda One:regular',
					'Merriweather' => 'Merriweather:300,300italic,regular,italic,700,700italic,900,900italic',
					'Merriweather Sans' => 'Merriweather Sans:300,300italic,regular,italic,700,700italic,800,800italic',
					'Metal' => 'Metal:regular',
					'Metal Mania' => 'Metal Mania:regular',
					'Metamorphous' => 'Metamorphous:regular',
					'Metrophobic' => 'Metrophobic:regular',
					'Michroma' => 'Michroma:regular',
					'Milonga' => 'Milonga:regular',
					'Miltonian' => 'Miltonian:regular',
					'Miltonian Tattoo' => 'Miltonian Tattoo:regular',
					'Miniver' => 'Miniver:regular',
					'Miriam Libre' => 'Miriam Libre:regular,700',
					'Mirza' => 'Mirza:regular,500,600,700',
					'Miss Fajardose' => 'Miss Fajardose:regular',
					'Mitr' => 'Mitr:200,300,regular,500,600,700',
					'Modak' => 'Modak:regular',
					'Modern Antiqua' => 'Modern Antiqua:regular',
					'Mogra' => 'Mogra:regular',
					'Molengo' => 'Molengo:regular',
					'Molle' => 'Molle:italic',
					'Monda' => 'Monda:regular,700',
					'Monofett' => 'Monofett:regular',
					'Monoton' => 'Monoton:regular',
					'Monsieur La Doulaise' => 'Monsieur La Doulaise:regular',
					'Montaga' => 'Montaga:regular',
					'Montez' => 'Montez:regular',
					'Montserrat' => 'Montserrat:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Montserrat Alternates' => 'Montserrat Alternates:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Montserrat Subrayada' => 'Montserrat Subrayada:regular,700',
					'Moul' => 'Moul:regular',
					'Moulpali' => 'Moulpali:regular',
					'Mountains of Christmas' => 'Mountains of Christmas:regular,700',
					'Mouse Memoirs' => 'Mouse Memoirs:regular',
					'Mr Bedfort' => 'Mr Bedfort:regular',
					'Mr Dafoe' => 'Mr Dafoe:regular',
					'Mr De Haviland' => 'Mr De Haviland:regular',
					'Mrs Saint Delafield' => 'Mrs Saint Delafield:regular',
					'Mrs Sheppards' => 'Mrs Sheppards:regular',
					'Mukta Vaani' => 'Mukta Vaani:200,300,regular,500,600,700,800',
					'Muli' => 'Muli:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Mystery Quest' => 'Mystery Quest:regular',
					'NTR' => 'NTR:regular',
					'Neucha' => 'Neucha:regular',
					'Neuton' => 'Neuton:200,300,regular,italic,700,800',
					'New Rocker' => 'New Rocker:regular',
					'News Cycle' => 'News Cycle:regular,700',
					'Niconne' => 'Niconne:regular',
					'Nixie One' => 'Nixie One:regular',
					'Nobile' => 'Nobile:regular,italic,700,700italic',
					'Nokora' => 'Nokora:regular,700',
					'Norican' => 'Norican:regular',
					'Nosifer' => 'Nosifer:regular',
					'Nothing You Could Do' => 'Nothing You Could Do:regular',
					'Noticia Text' => 'Noticia Text:regular,italic,700,700italic',
					'Noto Sans' => 'Noto Sans:regular,italic,700,700italic',
					'Noto Serif' => 'Noto Serif:regular,italic,700,700italic',
					'Nova Cut' => 'Nova Cut:regular',
					'Nova Flat' => 'Nova Flat:regular',
					'Nova Mono' => 'Nova Mono:regular',
					'Nova Oval' => 'Nova Oval:regular',
					'Nova Round' => 'Nova Round:regular',
					'Nova Script' => 'Nova Script:regular',
					'Nova Slim' => 'Nova Slim:regular',
					'Nova Square' => 'Nova Square:regular',
					'Numans' => 'Numans:regular',
					'Nunito' => 'Nunito:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Nunito Sans' => 'Nunito Sans:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Odor Mean Chey' => 'Odor Mean Chey:regular',
					'Offside' => 'Offside:regular',
					'Old Standard TT' => 'Old Standard TT:regular,italic,700',
					'Oldenburg' => 'Oldenburg:regular',
					'Oleo Script' => 'Oleo Script:regular,700',
					'Oleo Script Swash Caps' => 'Oleo Script Swash Caps:regular,700',
					'Open Sans' => 'Open Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic',
					'Open Sans Condensed' => 'Open Sans Condensed:300,300italic,700',
					'Oranienbaum' => 'Oranienbaum:regular',
					'Orbitron' => 'Orbitron:regular,500,700,900',
					'Oregano' => 'Oregano:regular,italic',
					'Orienta' => 'Orienta:regular',
					'Original Surfer' => 'Original Surfer:regular',
					'Oswald' => 'Oswald:200,300,regular,500,600,700',
					'Over the Rainbow' => 'Over the Rainbow:regular',
					'Overlock' => 'Overlock:regular,italic,700,700italic,900,900italic',
					'Overlock SC' => 'Overlock SC:regular',
					'Overpass' => 'Overpass:100,100italic,200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Overpass Mono' => 'Overpass Mono:300,regular,600,700',
					'Ovo' => 'Ovo:regular',
					'Oxygen' => 'Oxygen:300,regular,700',
					'Oxygen Mono' => 'Oxygen Mono:regular',
					'PT Mono' => 'PT Mono:regular',
					'PT Sans' => 'PT Sans:regular,italic,700,700italic',
					'PT Sans Caption' => 'PT Sans Caption:regular,700',
					'PT Sans Narrow' => 'PT Sans Narrow:regular,700',
					'PT Serif' => 'PT Serif:regular,italic,700,700italic',
					'PT Serif Caption' => 'PT Serif Caption:regular,italic',
					'Pacifico' => 'Pacifico:regular',
					'Padauk' => 'Padauk:regular,700',
					'Palanquin' => 'Palanquin:100,200,300,regular,500,600,700',
					'Palanquin Dark' => 'Palanquin Dark:regular,500,600,700',
					'Pangolin' => 'Pangolin:regular',
					'Paprika' => 'Paprika:regular',
					'Parisienne' => 'Parisienne:regular',
					'Passero One' => 'Passero One:regular',
					'Passion One' => 'Passion One:regular,700,900',
					'Pathway Gothic One' => 'Pathway Gothic One:regular',
					'Patrick Hand' => 'Patrick Hand:regular',
					'Patrick Hand SC' => 'Patrick Hand SC:regular',
					'Pattaya' => 'Pattaya:regular',
					'Patua One' => 'Patua One:regular',
					'Pavanam' => 'Pavanam:regular',
					'Paytone One' => 'Paytone One:regular',
					'Peddana' => 'Peddana:regular',
					'Peralta' => 'Peralta:regular',
					'Permanent Marker' => 'Permanent Marker:regular',
					'Petit Formal Script' => 'Petit Formal Script:regular',
					'Petrona' => 'Petrona:regular',
					'Philosopher' => 'Philosopher:regular,italic,700,700italic',
					'Piedra' => 'Piedra:regular',
					'Pinyon Script' => 'Pinyon Script:regular',
					'Pirata One' => 'Pirata One:regular',
					'Plaster' => 'Plaster:regular',
					'Play' => 'Play:regular,700',
					'Playball' => 'Playball:regular',
					'Playfair Display' => 'Playfair Display:regular,italic,700,700italic,900,900italic',
					'Playfair Display SC' => 'Playfair Display SC:regular,italic,700,700italic,900,900italic',
					'Podkova' => 'Podkova:regular,500,600,700,800',
					'Poiret One' => 'Poiret One:regular',
					'Poller One' => 'Poller One:regular',
					'Poly' => 'Poly:regular,italic',
					'Pompiere' => 'Pompiere:regular',
					'Pontano Sans' => 'Pontano Sans:regular',
					'Poppins' => 'Poppins:300,regular,500,600,700',
					'Port Lligat Sans' => 'Port Lligat Sans:regular',
					'Port Lligat Slab' => 'Port Lligat Slab:regular',
					'Pragati Narrow' => 'Pragati Narrow:regular,700',
					'Prata' => 'Prata:regular',
					'Preahvihear' => 'Preahvihear:regular',
					'Press Start 2P' => 'Press Start 2P:regular',
					'Pridi' => 'Pridi:200,300,regular,500,600,700',
					'Princess Sofia' => 'Princess Sofia:regular',
					'Prociono' => 'Prociono:regular',
					'Prompt' => 'Prompt:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Prosto One' => 'Prosto One:regular',
					'Proza Libre' => 'Proza Libre:regular,italic,500,500italic,600,600italic,700,700italic,800,800italic',
					'Puritan' => 'Puritan:regular,italic,700,700italic',
					'Purple Purse' => 'Purple Purse:regular',
					'Quando' => 'Quando:regular',
					'Quantico' => 'Quantico:regular,italic,700,700italic',
					'Quattrocento' => 'Quattrocento:regular,700',
					'Quattrocento Sans' => 'Quattrocento Sans:regular,italic,700,700italic',
					'Questrial' => 'Questrial:regular',
					'Quicksand' => 'Quicksand:300,regular,500,700',
					'Quintessential' => 'Quintessential:regular',
					'Qwigley' => 'Qwigley:regular',
					'Racing Sans One' => 'Racing Sans One:regular',
					'Radley' => 'Radley:regular,italic',
					'Rajdhani' => 'Rajdhani:300,regular,500,600,700',
					'Rakkas' => 'Rakkas:regular',
					'Raleway' => 'Raleway:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Raleway Dots' => 'Raleway Dots:regular',
					'Ramabhadra' => 'Ramabhadra:regular',
					'Ramaraja' => 'Ramaraja:regular',
					'Rambla' => 'Rambla:regular,italic,700,700italic',
					'Rammetto One' => 'Rammetto One:regular',
					'Ranchers' => 'Ranchers:regular',
					'Rancho' => 'Rancho:regular',
					'Ranga' => 'Ranga:regular,700',
					'Rasa' => 'Rasa:300,regular,500,600,700',
					'Rationale' => 'Rationale:regular',
					'Ravi Prakash' => 'Ravi Prakash:regular',
					'Redressed' => 'Redressed:regular',
					'Reem Kufi' => 'Reem Kufi:regular',
					'Reenie Beanie' => 'Reenie Beanie:regular',
					'Revalia' => 'Revalia:regular',
					'Rhodium Libre' => 'Rhodium Libre:regular',
					'Ribeye' => 'Ribeye:regular',
					'Ribeye Marrow' => 'Ribeye Marrow:regular',
					'Righteous' => 'Righteous:regular',
					'Risque' => 'Risque:regular',
					'Roboto' => 'Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic',
					'Roboto Condensed' => 'Roboto Condensed:300,300italic,regular,italic,700,700italic',
					'Roboto Mono' => 'Roboto Mono:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic',
					'Roboto Slab' => 'Roboto Slab:100,300,regular,700',
					'Rochester' => 'Rochester:regular',
					'Rock Salt' => 'Rock Salt:regular',
					'Rokkitt' => 'Rokkitt:100,200,300,regular,500,600,700,800,900',
					'Romanesco' => 'Romanesco:regular',
					'Ropa Sans' => 'Ropa Sans:regular,italic',
					'Rosario' => 'Rosario:regular,italic,700,700italic',
					'Rosarivo' => 'Rosarivo:regular,italic',
					'Rouge Script' => 'Rouge Script:regular',
					'Rozha One' => 'Rozha One:regular',
					'Rubik' => 'Rubik:300,300italic,regular,italic,500,500italic,700,700italic,900,900italic',
					'Rubik Mono One' => 'Rubik Mono One:regular',
					'Ruda' => 'Ruda:regular,700,900',
					'Rufina' => 'Rufina:regular,700',
					'Ruge Boogie' => 'Ruge Boogie:regular',
					'Ruluko' => 'Ruluko:regular',
					'Rum Raisin' => 'Rum Raisin:regular',
					'Ruslan Display' => 'Ruslan Display:regular',
					'Russo One' => 'Russo One:regular',
					'Ruthie' => 'Ruthie:regular',
					'Rye' => 'Rye:regular',
					'Sacramento' => 'Sacramento:regular',
					'Sahitya' => 'Sahitya:regular,700',
					'Sail' => 'Sail:regular',
					'Salsa' => 'Salsa:regular',
					'Sanchez' => 'Sanchez:regular,italic',
					'Sancreek' => 'Sancreek:regular',
					'Sansita' => 'Sansita:regular,italic,700,700italic,800,800italic,900,900italic',
					'Sarala' => 'Sarala:regular,700',
					'Sarina' => 'Sarina:regular',
					'Sarpanch' => 'Sarpanch:regular,500,600,700,800,900',
					'Satisfy' => 'Satisfy:regular',
					'Scada' => 'Scada:regular,italic,700,700italic',
					'Scheherazade' => 'Scheherazade:regular,700',
					'Schoolbell' => 'Schoolbell:regular',
					'Scope One' => 'Scope One:regular',
					'Seaweed Script' => 'Seaweed Script:regular',
					'Secular One' => 'Secular One:regular',
					'Sevillana' => 'Sevillana:regular',
					'Seymour One' => 'Seymour One:regular',
					'Shadows Into Light' => 'Shadows Into Light:regular',
					'Shadows Into Light Two' => 'Shadows Into Light Two:regular',
					'Shanti' => 'Shanti:regular',
					'Share' => 'Share:regular,italic,700,700italic',
					'Share Tech' => 'Share Tech:regular',
					'Share Tech Mono' => 'Share Tech Mono:regular',
					'Shojumaru' => 'Shojumaru:regular',
					'Short Stack' => 'Short Stack:regular',
					'Shrikhand' => 'Shrikhand:regular',
					'Siemreap' => 'Siemreap:regular',
					'Sigmar One' => 'Sigmar One:regular',
					'Signika' => 'Signika:300,regular,600,700',
					'Signika Negative' => 'Signika Negative:300,regular,600,700',
					'Simonetta' => 'Simonetta:regular,italic,900,900italic',
					'Sintony' => 'Sintony:regular,700',
					'Sirin Stencil' => 'Sirin Stencil:regular',
					'Six Caps' => 'Six Caps:regular',
					'Skranji' => 'Skranji:regular,700',
					'Slabo 13px' => 'Slabo 13px:regular',
					'Slabo 27px' => 'Slabo 27px:regular',
					'Slackey' => 'Slackey:regular',
					'Smokum' => 'Smokum:regular',
					'Smythe' => 'Smythe:regular',
					'Sniglet' => 'Sniglet:regular,800',
					'Snippet' => 'Snippet:regular',
					'Snowburst One' => 'Snowburst One:regular',
					'Sofadi One' => 'Sofadi One:regular',
					'Sofia' => 'Sofia:regular',
					'Sonsie One' => 'Sonsie One:regular',
					'Sorts Mill Goudy' => 'Sorts Mill Goudy:regular,italic',
					'Source Code Pro' => 'Source Code Pro:200,300,regular,500,600,700,900',
					'Source Sans Pro' => 'Source Sans Pro:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,900,900italic',
					'Source Serif Pro' => 'Source Serif Pro:regular,600,700',
					'Space Mono' => 'Space Mono:regular,italic,700,700italic',
					'Special Elite' => 'Special Elite:regular',
					'Spectral' => 'Spectral:200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic',
					'Spicy Rice' => 'Spicy Rice:regular',
					'Spinnaker' => 'Spinnaker:regular',
					'Spirax' => 'Spirax:regular',
					'Squada One' => 'Squada One:regular',
					'Sree Krushnadevaraya' => 'Sree Krushnadevaraya:regular',
					'Sriracha' => 'Sriracha:regular',
					'Stalemate' => 'Stalemate:regular',
					'Stalinist One' => 'Stalinist One:regular',
					'Stardos Stencil' => 'Stardos Stencil:regular,700',
					'Stint Ultra Condensed' => 'Stint Ultra Condensed:regular',
					'Stint Ultra Expanded' => 'Stint Ultra Expanded:regular',
					'Stoke' => 'Stoke:300,regular',
					'Strait' => 'Strait:regular',
					'Sue Ellen Francisco' => 'Sue Ellen Francisco:regular',
					'Suez One' => 'Suez One:regular',
					'Sumana' => 'Sumana:regular,700',
					'Sunshiney' => 'Sunshiney:regular',
					'Supermercado One' => 'Supermercado One:regular',
					'Sura' => 'Sura:regular,700',
					'Suranna' => 'Suranna:regular',
					'Suravaram' => 'Suravaram:regular',
					'Suwannaphum' => 'Suwannaphum:regular',
					'Swanky and Moo Moo' => 'Swanky and Moo Moo:regular',
					'Syncopate' => 'Syncopate:regular,700',
					'Tangerine' => 'Tangerine:regular,700',
					'Taprom' => 'Taprom:regular',
					'Tauri' => 'Tauri:regular',
					'Taviraj' => 'Taviraj:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Teko' => 'Teko:300,regular,500,600,700',
					'Telex' => 'Telex:regular',
					'Tenali Ramakrishna' => 'Tenali Ramakrishna:regular',
					'Tenor Sans' => 'Tenor Sans:regular',
					'Text Me One' => 'Text Me One:regular',
					'The Girl Next Door' => 'The Girl Next Door:regular',
					'Tienne' => 'Tienne:regular,700,900',
					'Tillana' => 'Tillana:regular,500,600,700,800',
					'Timmana' => 'Timmana:regular',
					'Tinos' => 'Tinos:regular,italic,700,700italic',
					'Titan One' => 'Titan One:regular',
					'Titillium Web' => 'Titillium Web:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,900',
					'Trade Winds' => 'Trade Winds:regular',
					'Trirong' => 'Trirong:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
					'Trocchi' => 'Trocchi:regular',
					'Trochut' => 'Trochut:regular,italic,700',
					'Trykker' => 'Trykker:regular',
					'Tulpen One' => 'Tulpen One:regular',
					'Ubuntu' => 'Ubuntu:300,300italic,regular,italic,500,500italic,700,700italic',
					'Ubuntu Condensed' => 'Ubuntu Condensed:regular',
					'Ubuntu Mono' => 'Ubuntu Mono:regular,italic,700,700italic',
					'Ultra' => 'Ultra:regular',
					'Uncial Antiqua' => 'Uncial Antiqua:regular',
					'Underdog' => 'Underdog:regular',
					'Unica One' => 'Unica One:regular',
					'UnifrakturCook' => 'UnifrakturCook:700',
					'UnifrakturMaguntia' => 'UnifrakturMaguntia:regular',
					'Unkempt' => 'Unkempt:regular,700',

					'Unlock' => 'Unlock:regular',
					'Unna' => 'Unna:regular,italic,700,700italic',
					'VT323' => 'VT323:regular',
					'Vampiro One' => 'Vampiro One:regular',
					'Varela' => 'Varela:regular',
					'Varela Round' => 'Varela Round:regular',
					'Vast Shadow' => 'Vast Shadow:regular',
					'Vesper Libre' => 'Vesper Libre:regular,500,700,900',
					'Vibur' => 'Vibur:regular',
					'Vidaloka' => 'Vidaloka:regular',
					'Viga' => 'Viga:regular',
					'Voces' => 'Voces:regular',
					'Volkhov' => 'Volkhov:regular,italic,700,700italic',
					'Vollkorn' => 'Vollkorn:regular,italic,700,700italic',
					'Voltaire' => 'Voltaire:regular',
					'Waiting for the Sunrise' => 'Waiting for the Sunrise:regular',
					'Wallpoet' => 'Wallpoet:regular',
					'Walter Turncoat' => 'Walter Turncoat:regular',
					'Warnes' => 'Warnes:regular',
					'Wellfleet' => 'Wellfleet:regular',
					'Wendy One' => 'Wendy One:regular',
					'Wire One' => 'Wire One:regular',
					'Work Sans' => 'Work Sans:100,200,300,regular,500,600,700,800,900',
					'Yanone Kaffeesatz' => 'Yanone Kaffeesatz:200,300,regular,700',
					'Yantramanav' => 'Yantramanav:100,300,regular,500,700,900',
					'Yatra One' => 'Yatra One:regular',
					'Yellowtail' => 'Yellowtail:regular',
					'Yeseva One' => 'Yeseva One:regular',
					'Yesteryear' => 'Yesteryear:regular',
					'Yrsa' => 'Yrsa:300,regular,500,600,700',
					'Zeyada' => 'Zeyada:regular',
					'Zilla Slab' => 'Zilla Slab:300,300italic,regular,italic,500,500italic,600,600italic,700,700italic'
				), 10, 1
			);
	}
endif;

$newsplus_google_font_list = newsplus_google_font_list();

$newsplus_options = array(
		array( 'type'	=> 'wrap_start' ),

		array( 'type'	=> 'tabs_start' ),

		array(
			'name'		=> __( 'General', 'newsplus' ),
			'id'		=> 'pls_general',
			'type'		=> 'heading'
		),

		array(
			'name'		=> __( 'Header', 'newsplus' ),
			'id'		=> 'pls_header_area',
			'type'		=> 'heading'
		),

		array(
			'name'		=> __( 'Archives', 'newsplus' ),
			'id'		=> 'pls_blog',
			'type'		=> 'heading'
		),

		array(
			'name'		=> __( 'Single Post', 'newsplus' ),
			'id'		=> 'pls_single',
			'type'		=> 'heading'
		),

		array(
			'name'		=> __( 'Contact', 'newsplus' ),
			'id'		=> 'pls_contact',
			'type'		=> 'heading'
		),

		array(
			'name'		=> __( 'Footer', 'newsplus' ),
			'id'		=> 'pls_footer',
			'type'		=> 'heading'
		),

		array(
			'name'		=> __( 'Custom Font', 'newsplus' ),
			'id'		=> 'pls_custom_font',
			'type'		=> 'heading'
		),

		array(
			'name'		=> __( 'Image Sizes', 'newsplus' ),
			'id'		=> 'pls_image_sizes',
			'type'		=> 'heading'
		),

		array(
			'name'		=> __( 'Custom Menus', 'newsplus' ),
			'id'		=> 'pls_custom_menus',
			'type'		=> 'heading'
		),

		array(
			'name'		=> __( 'Import / Export', 'newsplus' ),
			'id'		=> 'pls_import_export',
			'type'		=> 'heading'
		),

		array( 'type'	=> 'tabs_end' ),

		array(
			'type'		=> 'tabbed_start',
			'id'		=> 'pls_general'
		),

		array(
			'name'		=> __( 'General Settings for the theme', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_color_scheme' => array(
			'name'		=> __( 'Color scheme', 'newsplus' ),
			'desc'		=> __( 'Select a color scheme for theme highlights like main menu and footer widget area.', 'newsplus' ),
			'id'		=> 'pls_color_scheme',
			'std'		=> 'customizer',
			'type'		=> 'select',
			'options'	=> array(
							__( 'Use customizer', 'newsplus' ) => 'customizer',
							__( 'Default', 'newsplus' ) => 'default',
							__( 'Blue', 'newsplus' ) => 'blue',
							__( 'Brown', 'newsplus' ) => 'brown',
							__( 'Charcoal', 'newsplus' ) => 'charcoal',
							__( 'Cyan', 'newsplus' ) => 'cyan',
							__( 'Green', 'newsplus' ) => 'green',
							__( 'Grey', 'newsplus' ) => 'grey',
							__( 'Magenta', 'newsplus' ) => 'magenta',
							__( 'Red', 'newsplus' ) => 'red',
							__( 'Orange', 'newsplus' ) => 'orange',
							__( 'Teal', 'newsplus' ) => 'teal'
						)
		),

		'pls_layout' => array(
			'name'		=> __( 'Layout Style:', 'newsplus' ),
			'desc'		=> __( 'Select a layout style for the theme.', 'newsplus' ),
			'id'		=> 'pls_layout',
			'std'		=> 'boxed',
			'type'		=> 'select',
			'options'	=> array( 'Boxed' => 'boxed', 'Stretched' => 'stretched' )
		),

		'pls_layout_width' => array(
			'name'		=> __( 'Layout Width:', 'newsplus' ),
			'desc'		=> __( 'Enter a layout width in px (without unit). Min: 800, Max: 1600', 'newsplus' ),
			'id'		=> 'pls_layout_width',
			'std'		=> '1160',
			'type'		=> 'number',
			'min'		=> '800',
			'max'		=> '1600'
		),

		'pls_gutter' => array(
			'name'		=> __( 'Gutter width', 'newsplus' ),
			'desc'		=> __( 'Enter gutter width or gap between content and sidebar (in px, without unit). Min: 0, Max: 120', 'newsplus' ),
			'id'		=> 'pls_gutter',
			'std'		=> '24',
			'type'		=> 'number',
			'min'		=> '0',
			'max'		=> '120'
		),

		'pls_base_font_size' => array(
			'name'		=> __( 'Base font size:', 'newsplus' ),
			'desc'		=> __( 'Enter a base font size in px (without unit). Min: 11, Max: 18', 'newsplus' ),
			'id'		=> 'pls_base_font_size',
			'std'		=> '13',
			'type'		=> 'number',
			'min'		=> '11',
			'max'		=> '18'
		),

		'pls_sb_pos' => array(
			'name'		=> __( 'Global Site layout', 'newsplus' ),
			'desc'		=> __( 'Select a global site layout.', 'newsplus' ),
			'id'		=> 'pls_sb_pos',
			'std'		=> 'ca',
			'type'		=> 'select',
			'options'	=> array(
							__( 'Content + Sidebar A', 'newsplus' ) => 'ca',
							__( 'Sidebar A + Content', 'newsplus' ) => 'ac',
							__( 'Content + Sidebar B + Sidebar A', 'newsplus' ) => 'cab',
							__( 'Sidebar A + Content + Sidebar B', 'newsplus' ) => 'acb',
							__( 'Sidebar B + Content + Sidebar A', 'newsplus' ) => 'bca',
							__( 'Sidebar A + Sidebar B + Content', 'newsplus' ) => 'abc',
							__( 'No Sidebars', 'newsplus' ) => 'no-sb'
						)
		),

		'pls_sb_ratio' => array(
			'name'		=> __( 'Main Content + Sidebar A ratio', 'newsplus' ),
			'desc'		=> __( 'Select a split ratio (in %) for main content and sidebar A column.', 'newsplus' ),
			'id'		=> 'pls_sb_ratio',
			'std'		=> '70-30',
			'type'		=> 'select',
			'options'	=> array( '70-30', '75-25', '66-33', '60-40', '50-50' )
		),

		'pls_custom_head_code' => array(
			'name'		=> __( 'Custom head markup:', 'newsplus' ),
			'desc'		=> __( 'Use this section for inserting any custom CSS or script inside head node of the site. For example, Google Analytics code, Google font CSS, or custom scripts.', 'newsplus' ),
			'id'		=> 'pls_custom_head_code',
			'std'		=> '',
			'type'		=> 'textarea'
		),

		'pls_schema' => array(
			'name'		=> __( 'Schema Markup', 'newsplus' ),
			'label'		=> __( 'Enable Schema Microdata on entire site.', 'newsplus' ),
			'desc'		=> __( 'When using shortcodes, you can enable or disable schema using enable_schema=\'true\' parameter inside shortcodes.', 'newsplus' ),
			'id'		=> 'pls_schema',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_date_format' => array(
			'name'		=> __( 'Date format', 'newsplus' ),
			'desc'		=> __( 'Select a date format for archives and posts', 'newsplus' ),
			'id'		=> 'pls_date_format',
			'std'		=> 'global',
			'type'		=> 'select',
			'options'	=> array( 'Global' => 'global', 'Human Time Difference' => 'human' )
		),

		'pls_hide_crumbs' => array(
			'name'		=> __( 'Breadcrumbs', 'newsplus' ),
			'label'		=> __( 'Hide breadcrumbs on all pages', 'newsplus' ),
			'id'		=> 'pls_hide_crumbs',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_collapse_lists' => array(
			'name'		=> __( 'Collapsible widget lists', 'newsplus' ),
			'label'		=> __( 'Enable collapsible list items in widgets', 'newsplus' ),
			'desc'		=> __( 'If enabled, sub-lists in widgets like category, pages and custom menu will be converted into accordion like collapsible items.', 'newsplus' ),
			'id'		=> 'pls_collapse_lists',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_disable_resp_css' => array(
			'name'		=> __( 'Responsive CSS', 'newsplus' ),
			'label'		=> __( 'Disable responsive.css file', 'newsplus' ),
			'id'		=> 'pls_disable_resp_css',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_disable_resp_menu' => array(
			'name'		=> __( 'Responsive menu', 'newsplus' ),
			'label'		=> __( 'Disable responsive menu', 'newsplus' ),
			'desc'		=> __( 'Check to disable only the responsive menu. This option is useful when using mega menu plugins which add their own responsive menu. In that case theme menu shall be disabled.', 'newsplus' ),
			'id'		=> 'pls_disable_resp_menu',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_disable_user_css' => array(
			'name'		=> __( 'User CSS', 'newsplus' ),
			'label'		=> __( 'Disable user.css file', 'newsplus' ),
			'desc'		=> __( 'Check to disable user.css file. Located as <code>newsplus/user.css</code> This file can be used to add your custom styles without modifying actual style.css file.', 'newsplus' ),
			'id'		=> 'pls_disable_user_css',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_enable_rtl_css' => array(
			'name'		=> __( 'RTL CSS', 'newsplus' ),
			'label'		=> __( 'Enable rtl.css file', 'newsplus' ),
			'desc'		=> __( 'Check to enable rtl.css file. Located as <code>newsplus/rtl.css</code> If using RTL installation of WordPress, this file is automatically loaded. You can also load it forcefully by enabling this option.', 'newsplus' ),
			'id'		=> 'pls_enable_rtl_css',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_secondary' => array(
			'name'		=> __( 'Secondary Widget Area', 'newsplus' ),
			'label'		=> __( 'Hide Secondary Widget Area', 'newsplus' ),
			'desc'		=> __( 'Hide secondary widget area on archives, category, search, author etc. You can control individual setting for Pages and Posts inside their options panel.', 'newsplus' ),
			'id'		=> 'pls_hide_secondary',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_page_titles' => array(
			'name'		=> __( 'Page Titles', 'newsplus' ),
			'label'		=> __( 'Hide page titles', 'newsplus' ),
			'desc'		=> __( 'Hide page titles globally across entire site.<br/> You can also hide page titles per page using page options panel.', 'newsplus' ),
			'id'		=> 'pls_hide_page_titles',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_fa' => array(
			'name'		=> __( 'FontAwesome CSS', 'newsplus' ),
			'label'		=> __( 'Disable Font Awesome CSS file', 'newsplus' ),
			'desc'		=> __( 'This will disable fontawesome CSS file for entire site.', 'newsplus' ),
			'id'		=> 'pls_fa',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_page_header' => array(
			'name'		=> __( 'Page Title Header', 'newsplus' ),
			'desc'		=> __( 'Select a header style for page title', 'newsplus' ),
			'id'		=> 'pls_page_header',
			'std'		=> 'inline',
			'type'		=> 'select',
			'options'	=> array(
							'Inline' => 'inline',
							'Full Width Classic' => 'full',
							'Full Width Overlay' => 'overlay'
						)
		),

		'pls_overlay_exclude' => array(
			'name'		=> __( 'Overlay Page Title Exclude', 'newsplus' ),
			'desc'		=> __( 'Provide page IDs, separated by comma, on which you wish to exlude overlay style page title header. E.g. 21,34,55', 'newsplus' ),
			'id'		=> 'pls_overlay_exclude',
			'std'		=> '',
			'type'		=> 'text'
		),

		array( 'type'	=> 'tabbed_end' ),

		array(
			'type'		=> 'tabbed_start',
			'id'		=> 'pls_header_area'
		),

		array(
			'name'		=> __( 'Header Area Settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_header_style' => array(
			'name'		=> __( 'Header Style', 'newsplus' ),
			'desc'		=> __( 'Select a header style for the site.', 'newsplus' ),
			'id'		=> 'pls_header_style',
			'std'		=> 'default',
			'type'		=> 'select',
			'options'	=> array(
							__( 'Default', 'newsplus' ) => 'default',
							__( 'Three columnar', 'newsplus' ) => 'three-col',
							__( 'Full width', 'newsplus' ) => 'full-width',
							__( 'Slim inline', 'newsplus' ) => 'slim'
						)
		),

		'pls_top_bar_sticky' => array(
			'name'		=> __( 'Top sticky nav', 'newsplus' ),
			'label'		=> __( 'Enable sticky top utility bar', 'newsplus' ),
			'id'		=> 'pls_top_bar_sticky',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_main_bar_sticky' => array(
			'name'		=> __( 'Main sticky nav', 'newsplus' ),
			'label'		=> __( 'Enable sticky main navigation bar', 'newsplus' ),
			'id'		=> 'pls_main_bar_sticky',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_disable_sticky_on_mobile' => array(
			'name'		=> __( 'Sticky nav on mobile', 'newsplus' ),
			'label'		=> __( 'Disable sticky navbars on mobile', 'newsplus' ),
			'id'		=> 'pls_disable_sticky_on_mobile',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_inline_search_box' => array(
			'name'		=> __( 'Search box in main menu', 'newsplus' ),
			'label'		=> __( 'Enable search box in main navigation bar', 'newsplus' ),
			'id'		=> 'pls_inline_search_box',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		array(
			'name'		=> __( 'Site Name/Logo Settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_logo_check' => array(
			'name'		=> __( 'Site logo', 'newsplus' ),
			'label'		=> __( 'Show logo as image', 'newsplus' ),
			'desc'		=> __( 'Check to display logo image instead of site name and description', 'newsplus' ),
			'id'		=> 'pls_logo_check',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_desc' => array(
			'name'		=> __( 'Hide site description', 'newsplus' ),
			'label'		=> __( 'Hide site description', 'newsplus' ),
			'desc'		=> __( 'Check to hide site description.', 'newsplus' ),
			'id'		=> 'pls_hide_desc',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_logo' => array(
			'name'		=> __( 'Logo URL', 'newsplus' ),
			'desc'		=> __( 'Browse the logo image from media library or paste external URL.', 'newsplus' ),
			'id'		=> 'pls_logo',
			'std'		=> '',
			'type'		=> 'image_uploader'
		),

		'pls_logo_retina' => array(
			'name'		=> __( 'Retina Logo URL', 'newsplus' ),
			'desc'		=> __( 'High resolution logo image @2x size for display on retina devices.', 'newsplus' ),
			'id'		=> 'pls_logo_retina',
			'std'		=> '',
			'type'		=> 'image_uploader'
		),

		'pls_custom_title' => array(
			'name'		=> __( 'Custom Site Title', 'newsplus' ),
			'desc'		=> __( 'Enter custom site title other than your default site title. This is used to allow HTML in site title. This title will be shown when not using logo image.', 'newsplus' ),
			'id'		=> 'pls_custom_title',
			'std'		=> '',
			'type'		=> 'text'
		),

		'pls_logo_align' => array(
			'name'		=> __( 'Logo Placement', 'newsplus' ),
			'desc'		=> __( 'Select a logo placement in header area. If chosen none, logo will be replaced by widget area. The \'center\' alignment is applied only to full width or three columnar header style.', 'newsplus' ),
			'id'		=> 'pls_logo_align',
			'std'		=> 'left',
			'type'		=> 'select',
			'options'	=> array(
							__( 'Left', 'newsplus' ) => 'left',
							__( 'Center', 'newsplus' ) => 'center',
							__( 'Right', 'newsplus' ) => 'right',
							__( 'None', 'newsplus' ) => 'none'
						)
		),

		'pls_menu_align' => array(
			'name'		=> __( 'Menu alignment', 'newsplus' ),
			'desc'		=> __( 'Select a menu alignment. The center align is not applicable on Slim header style.', 'newsplus' ),
			'id'		=> 'pls_menu_align',
			'std'		=> 'default',
			'type'		=> 'select',
			'options'	=> array(
							__( 'Default', 'newsplus' ) => 'default',
							__( 'Center', 'newsplus' ) => 'center'
						)
		),

		array(
			'name'		=> __( 'News Ticker Settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_ticker_placement' => array(
			'name'		=> __( 'News Ticker Placement', 'newsplus' ),
			'desc'		=> __( 'Choose where to display news ticker automatically. (You can use the [newsplus_news_ticker] shortcode on individual pages as well).', 'newsplus' ),
			'id'		=> 'pls_ticker_placement',
			'std'		=> 'none',
			'type'		=> 'select',
			'options'	=> array(
							__( 'None', 'newsplus' ) => 'none',
							__( 'Below Top Menu', 'newsplus' ) => 'below_top_menu',
							__( 'Below Main Menu', 'newsplus' ) => 'below_main_menu'
						)
		),

		'pls_ticker_cats' => array(
			'name'		=> __( 'Category IDs for news ticker', 'newsplus' ),
			'desc'		=> __( 'Provide numeric category IDs, separated by comma, from which posts shall be displayed in news ticker. E.g. 3,15,24', 'newsplus' ),
			'id'		=> 'pls_ticker_cats',
			'std'		=> '',
			'type'		=> 'text'
		),

		'pls_ticker_num' => array(
			'name'		=> __( 'Number of posts in ticker', 'newsplus' ),
			'desc'		=> __( 'Enter number of posts to be shown in ticker. E.g. 5', 'newsplus' ),
			'id'		=> 'pls_ticker_num',
			'std'		=> '5',
			'type'		=> 'number',
			'min'		=> '1',
			'max'		=> '999'
		),

		'pls_ticker_label' => array(
			'name'		=> __( 'News Ticker Label', 'newsplus' ),
			'desc'		=> __( 'Provide a ticker label text. Default is \'Breaking News\'.', 'newsplus' ),
			'id'		=> 'pls_ticker_label',
			'std'		=> '',
			'type'		=> 'text'
		),

		'pls_ticker_home_check' => array(
			'name'		=> __( 'Limit to Home page', 'newsplus' ),
			'label'		=> __( 'Show news ticker only on Home page', 'newsplus' ),
			'id'		=> 'pls_ticker_home_check',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		array(
			'name'		=> __( 'Top Navbar Settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_cb_item_left' => array(
			'name'		=> __( 'Top Left callout section', 'newsplus' ),
			'desc'		=> __( 'Choose what to display inside top-left callout section. Optional menu, or custom text.', 'newsplus' ),
			'id'		=> 'pls_cb_item_left',
			'std'		=> 'menu',
			'type'		=> 'select',
			'options'	=> array(
							__( 'Nav Menu', 'newsplus' ) => 'menu',
							__( 'Text Content', 'newsplus' ) => 'text'
						)
		),

		'pls_cb_text_left' => array(
			'name'		=> __( 'Top left Callout Text:', 'newsplus' ),
			'desc'		=> __( 'Enter custom text that should appear on left side of top utility bar.', 'newsplus' ),
			'id'		=> 'pls_cb_text_left',
			'std'		=> 'Optional callout text left side.',
			'type'		=> 'textarea'
		),

		'pls_cb_item_right' => array(
			'name'		=> __( 'Top Right callout section', 'newsplus' ),
			'desc'		=> __( 'Choose what to display inside top-right callout section. Searchform, custom text, or shopping cart.', 'newsplus' ),
			'id'		=> 'pls_cb_item_right',
			'std'		=> 'searchform',
			'type'		=> 'select',
			'options'	=> array(
							__( 'Searchform', 'newsplus' ) => 'searchform',
							__( 'Text Content', 'newsplus' ) => 'text',
							__( 'WooCommerce Cart', 'newsplus' ) => 'cart'
						)
		),

		'pls_cb_text_right' => array(
			'name'		=> __( 'Top Right Callout Text:', 'newsplus' ),
			'desc'		=> __( 'Enter custom text that should appear on right side of top utility bar.', 'newsplus' ),
			'id'		=> 'pls_cb_text_right',
			'std'		=> 'Optional callout text right side.',
			'type'		=> 'textarea'
		),

		'pls_top_bar_hide' => array(
			'name'		=> __( 'Disable top bar', 'newsplus' ),
			'label'		=> __( 'Disable top utility bar', 'newsplus' ),
			'id'		=> 'pls_top_bar_hide',
			'type'		=> 'checkbox',
			'std'		=> false
		),



		array( 'type'	=> 'tabbed_end' ),

		array(
			'type'		=> 'tabbed_start',
			'id'		=> 'pls_blog'
		),

		array(
			'name'		=> __( 'Archive Settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_archive_template' => array(
			'name'		=> __( 'Global Archives Template', 'newsplus' ),
			'desc'		=> __( 'Select a template for default blog and archives.', 'newsplus' ),
			'id'		=> 'pls_archive_template',
			'std'		=> 'grid',
			'type'		=> 'select',
			'options'	=> array(
							__( 'Grid', 'newsplus' ) => 'grid',
							__( 'List Big', 'newsplus' ) => 'list',
							__( 'Classic', 'newsplus' ) => 'classic',
							__( 'Full Posts', 'newsplus' ) => 'full',
							__( 'Card', 'newsplus' ) => 'card',
						)
		),

		'pls_grid_col' => array(
			'name'		=> __( 'Grid columns', 'newsplus' ),
			'desc'		=> __( 'Select number of grid columns for grid style archives.', 'newsplus' ),
			'id'		=> 'pls_grid_col',
			'std'		=> '2',
			'type'		=> 'select',
			'options'	=> array( '2', '3', '4')
		),

		'pls_list_split' => array(
			'name'		=> __( 'List split ratio', 'newsplus' ),
			'desc'		=> __( 'Select split ratio for thumbnail + content inside list style archives.', 'newsplus' ),
			'id'		=> 'pls_list_split',
			'std'		=> '33-67',
			'type'		=> 'select',
			'options'	=> array(
				'33% - 67%' => '33-67',
				'20% - 80%' => '20-80',
				'25% - 75%' => '25-75',
				'40% - 60%' => '40-60',
				'50% - 50%' => '50-50',
			)
		),

		'pls_archive_fw' => array(
			'name'		=> __( 'Archive full width', 'newsplus' ),
			'label'		=> __( 'Enable full width on archive templates', 'newsplus' ),
			'desc'		=> __( 'This option will hide sidebar on all archives.', 'newsplus' ),
			'id'		=> 'pls_archive_fw',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_enable_masonry' => array(
			'name'		=> __( 'Masonry layout', 'newsplus' ),
			'label'		=> __( 'Enable masonry layout on grid archive templates', 'newsplus' ),
			'id'		=> 'pls_enable_masonry',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_short_title' => array(
			'name'		=> __( 'Short titles', 'newsplus' ),
			'label'		=> __( 'Enable short title support in post archives.', 'newsplus' ),
			'desc'		=> __( 'It will be required to add a custom field \'np_short_title\' to the post with the value as your short title.', 'newsplus' ),
			'id'		=> 'pls_short_title',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_ext_link' => array(
			'name'		=> __( 'Custom links', 'newsplus' ),
			'label'		=> __( 'Enable custom links support in post archives.', 'newsplus' ),
			'desc'		=> __( 'It will be required to add a custom field \'np_custom_link\' to the post with the value as your custom link. This option is useful to show affiliate links in post archives.', 'newsplus' ),
			'id'		=> 'pls_ext_link',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_blog_full_images' => array(
			'name'		=> __( 'Auto featured images', 'newsplus' ),
			'label'		=> __( 'Disable auto insertion of featured images in Blog - full style', 'newsplus' ),
			'id'		=> 'pls_hide_blog_full_images',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_disable_video' => array(
			'name'		=> __( 'Video embeds', 'newsplus' ),
			'label'		=> __( 'Disable video embed in post archives', 'newsplus' ),
			'desc'		=> __( 'If checked, a featured image with video icon will be shown.', 'newsplus' ),
			'id'		=> 'pls_disable_video',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_use_word_length' => array(
			'name'		=> __( 'Excerpt shortening', 'newsplus' ),
			'label'		=> __( 'Enable word length in archive excerpts', 'newsplus' ),
			'desc'		=> __( 'Check to enable word length in archive excerpts. By default character length is used which may not work well in Chinese characters. So use word length for Chinese language.', 'newsplus' ),
			'id'		=> 'pls_use_word_length',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_word_length' => array(
			'name'		=> __( 'Word length for archive excerpts', 'newsplus' ),
			'desc'		=> __( 'Enter a word length for archive excerpts.', 'newsplus' ),
			'id'		=> 'pls_word_length',
			'std'		=> '20',
			'type'		=> 'number',
			'min'		=> '1',
			'max'		=> '999'
		),

		'pls_char_length' => array(
			'name'		=> __( 'Character length for archive excerpts', 'newsplus' ),
			'desc'		=> __( 'Enter a character length for archive excerpts. This will be used if Word length option is disabled.', 'newsplus' ),
			'id'		=> 'pls_char_length',
			'std'		=> '180',
			'type'		=> 'number',
			'min'		=> '1',
			'max'		=> '9999'
		),

		array(
			'name'		=> __( 'Post meta settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_hide_cats' => array(
			'name'		=> __( 'Category links', 'newsplus' ),
			'label'		=> __( 'Hide category links', 'newsplus' ),
			'id'		=> 'pls_hide_cats',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_reviews' => array(
			'name'		=> __( 'Review Stars', 'newsplus' ),
			'label'		=> __( 'Hide review stars', 'newsplus' ),
			'id'		=> 'pls_hide_reviews',
			'desc'		=> __( 'This feature requires WP Review plugin.', 'newsplus' ),
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_views' => array(
			'name'		=> __( 'Post Views', 'newsplus' ),
			'label'		=> __( 'Hidepost views', 'newsplus' ),
			'id'		=> 'pls_hide_views',
			'desc'		=> __( 'This feature requires Post Views Counter plugin.', 'newsplus' ),
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_date' => array(
			'name'		=> __( 'Post Date', 'newsplus' ),
			'label'		=> __( 'Hide post date', 'newsplus' ),
			'id'		=> 'pls_hide_date',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_author' => array(
			'name'		=> __( 'Author link', 'newsplus' ),
			'label'		=> __( 'Hide author link', 'newsplus' ),
			'id'		=> 'pls_hide_author',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_show_avatar' => array(
			'name'		=> __( 'Author Avatar', 'newsplus' ),
			'label'		=> __( 'Show author avatar', 'newsplus' ),
			'id'		=> 'pls_show_avatar',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_excerpt' => array(
			'name'		=> __( 'Post excerpt', 'newsplus' ),
			'label'		=> __( 'Hide post excerpt', 'newsplus' ),
			'id'		=> 'pls_hide_excerpt',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_comments' => array(
			'name'		=> __( 'Comments link', 'newsplus' ),
			'label'		=> __( 'Hide comments link', 'newsplus' ),
			'id'		=> 'pls_hide_comments',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_readmore' => array(
			'name'		=> __( 'Readmore link', 'newsplus' ),
			'label'		=> __( 'Show a readmore link', 'newsplus' ),
			'id'		=> 'pls_readmore',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_inline_sharing' => array(
			'name'		=> __( 'Social Sharing', 'newsplus' ),
			'label'		=> __( 'Show social sharing per post in archives', 'newsplus' ),
			'id'		=> 'pls_inline_sharing',
			'type'		=> 'checkbox',
			'std'		=> false
		),

        'pls_inline_social_btns' => array(
			'name'		=> __( 'Buttons to show', 'newsplus' ),
			'desc'		=> __( 'Select social buttons to show on archive posts', 'newsplus' ),
			'id'		=> 'pls_inline_social_btns',
			'std'		=> '',
			'type'		=> 'multiselect',
			'options'	=> array(
							'Twitter' => 'twitter',
							'Facebook' => 'facebook',
							'Whatsapp' => 'whatsapp',
							'GooglePlus' => 'googleplus',
							'LinkedIn' => 'linkedin',
							'Pinterest' => 'pinterest',
							'VKOntakte' => 'vkontakte',
							'Email' => 'email',
							'Reddit' => 'reddit'
						)
		),

		'pls_sp_label' => array(
			'name'		=> __( 'Advertisement label for archives', 'newsplus' ),
			'desc'		=> __( 'Provide advertisement label for sponsored posts shown in archives. E.g. Advertisement', 'newsplus' ),
			'id'		=> 'pls_sp_label',
			'std'		=> __( 'Advertisement', 'newsplus' ),
			'type'		=> 'text'
		),

		'pls_sp_label_bg' => array(
			'name'		=> __( 'Advertisement label background color', 'newsplus' ),
			'desc'		=> __( 'Choose a background color for advertisement label', 'newsplus' ),
			'id'		=> 'pls_sp_label_bg',
			'std'		=> '#ffffff',
			'type'		=> 'color-picker'
		),

		'pls_sp_label_clr' => array(
			'name'		=> __( 'Advertisement label text color', 'newsplus' ),
			'desc'		=> __( 'Choose a text color for advertisement label', 'newsplus' ),
			'id'		=> 'pls_sp_label_clr',
			'std'		=> '#000000',
			'type'		=> 'color-picker'
		),

		'pls_sp_bg' => array(
			'name'		=> __( 'Advertisement post background color', 'newsplus' ),
			'desc'		=> __( 'Choose a background color for advertisement post in archives', 'newsplus' ),
			'id'		=> 'pls_sp_bg',
			'std'		=> '#fff9e5',
			'type'		=> 'color-picker'
		),

		array( 'type' 	=> 'tabbed_end' ),

		array(
			'type'		=> 'tabbed_start',
			'id'		=> 'pls_single'
		),

		array(
			'name'		=> __( 'Single post settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_sng_header' => array(
			'name'		=> __( 'Post Title Header', 'newsplus' ),
			'desc'		=> __( 'Select a header style for post title', 'newsplus' ),
			'id'		=> 'pls_sng_header',
			'std'		=> 'inline',
			'type'		=> 'select',
			'options'	=> array(
							'Inline' => 'inline',
							'Full Width Classic' => 'full',
							'Full Width Overlay' => 'overlay'
						)
		),

		'pls_hide_feat_image' => array(
			'name'		=> __( 'Disable single post image', 'newsplus' ),
			'label'		=> __( 'Disable auto insertion of featured images in single posts', 'newsplus' ),
			'id'		=> 'pls_hide_feat_image',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_feat_stamp' => array(
			'name'		=> __( 'Show images after date', 'newsplus' ),
			'desc'		=> __( 'If a date is provide, auto featured images will be shown for posts published after this date. E.g. 2007-01-01', 'newsplus' ),
			'id'		=> 'pls_feat_stamp',
			'std'		=> '1980-01-01',
			'type'		=> 'text'
		),

		'pls_disable_single_video' => array(
			'name'		=> __( 'Single post video', 'newsplus' ),
			'label'		=> __( 'Disable auto insertion of video embed in single posts', 'newsplus' ),
			'id'		=> 'pls_disable_single_video',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_author' => array(
			'name'		=> __( 'Author Bio', 'newsplus' ),
			'label'		=> __( 'Hide author bio on single post', 'newsplus' ),
			'id'		=> 'pls_author',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_post_navigation' => array(
			'name'		=> __( 'Posts navigation', 'newsplus' ),
			'label'		=> __( 'Hide posts navigation on single post', 'newsplus' ),
			'id'		=> 'pls_post_navigation',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_hide_tags' => array(
			'name'		=> __( 'Tag list', 'newsplus' ),
			'label'		=> __( 'Hide tag list in single posts', 'newsplus' ),
			'id'		=> 'pls_hide_tags',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		array(
			'name'		=> __( 'Post meta settings for Single posts', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_sng_hide_cats' => array(
			'name'		=> __( 'Category links', 'newsplus' ),
			'label'		=> __( 'Hide category links', 'newsplus' ),
			'id'		=> 'pls_sng_hide_cats',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_sng_hide_reviews' => array(
			'name'		=> __( 'Review Stars', 'newsplus' ),
			'label'		=> __( 'Hide review stars', 'newsplus' ),
			'id'		=> 'pls_sng_hide_reviews',
			'desc'		=> __( 'This feature requires WP Review plugin.', 'newsplus' ),
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_sng_hide_views' => array(
			'name'		=> __( 'Post Views', 'newsplus' ),
			'label'		=> __( 'Hidepost views', 'newsplus' ),
			'id'		=> 'pls_sng_hide_views',
			'desc'		=> __( 'This feature requires Post Views Counter plugin.', 'newsplus' ),
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_sng_hide_date' => array(
			'name'		=> __( 'Post Date', 'newsplus' ),
			'label'		=> __( 'Hide post date', 'newsplus' ),
			'id'		=> 'pls_sng_hide_date',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_sng_hide_author' => array(
			'name'		=> __( 'Author link', 'newsplus' ),
			'label'		=> __( 'Hide author link', 'newsplus' ),
			'id'		=> 'pls_sng_hide_author',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_sng_show_avatar' => array(
			'name'		=> __( 'Author Avatar', 'newsplus' ),
			'label'		=> __( 'Show author avatar', 'newsplus' ),
			'id'		=> 'pls_sng_show_avatar',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_sng_hide_comments' => array(
			'name'		=> __( 'Comments link', 'newsplus' ),
			'label'		=> __( 'Hide comments link', 'newsplus' ),
			'id'		=> 'pls_sng_hide_comments',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		array(
			'name'		=> __( 'Related posts settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_rp' => array(
			'name'		=> __( 'Related posts', 'newsplus' ),
			'label'		=> __( 'Hide related posts on single post', 'newsplus' ),
			'id'		=> 'pls_rp',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_rp_taxonomy' => array(
			'name'		=> __( 'Related posts taxonomy', 'newsplus' ),
			'desc'		=> __( 'Select a taxonomy for related posts.', 'newsplus' ),
			'id'		=> 'pls_rp_taxonomy',
			'std'		=> 'category',
			'type'		=> 'select',
			'options'	=> array(
							'Category' => 'category',
							'Tags' => 'tags'
						)
		),

		'pls_rp_style' => array(
			'name'		=> __( 'Related posts display style:', 'newsplus' ),
			'desc'		=> __( 'Select a display style for related posts.', 'newsplus' ),
			'id'		=> 'pls_rp_style',
			'std'		=> 'thumbnail',
			'type'		=> 'select',
			'options'	=> array(
							__( 'Thumbnail', 'newsplus' ) => 'thumbnail',
							__( 'List', 'newsplus' ) => 'list'
						)
		),

		'pls_rp_num' => array(
			'name'		=> __( 'Number of related posts to show:', 'newsplus' ),
			'desc'		=> __( 'Enter a number for posts to show.', 'newsplus' ),
			'id'		=> 'pls_rp_num',
			'std'		=> '3',
			'type'		=> 'number',
			'min'		=> '1',
			'max'		=> '999'
		),

		'pls_rp_grid_col' => array(
			'name'		=> __( 'Grid columns', 'newsplus' ),
			'desc'		=> __( 'Select number of grid columns for grid style related posts.', 'newsplus' ),
			'id'		=> 'pls_rp_grid_col',
			'std'		=> '3',
			'type'		=> 'select',
			'options'	=> array( '2', '3', '4')
		),

		array(
			'name'		=> __( 'Post meta settings for related posts', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_rp_hide_cats' => array(
			'name'		=> __( 'Category links', 'newsplus' ),
			'label'		=> __( 'Hide category links', 'newsplus' ),
			'id'		=> 'pls_rp_hide_cats',
			'type'		=> 'checkbox',
			'std'		=> true
		),

		'pls_rp_hide_reviews' => array(
			'name'		=> __( 'Review Stars', 'newsplus' ),
			'label'		=> __( 'Hide review stars', 'newsplus' ),
			'id'		=> 'pls_rp_hide_reviews',
			'desc'		=> __( 'This feature requires WP Review plugin.', 'newsplus' ),
			'type'		=> 'checkbox',
			'std'		=> true
		),

		'pls_rp_hide_views' => array(
			'name'		=> __( 'Post Views', 'newsplus' ),
			'label'		=> __( 'Hide post views', 'newsplus' ),
			'id'		=> 'pls_rp_hide_views',
			'desc'		=> __( 'This feature requires Post Views Counter plugin.', 'newsplus' ),
			'type'		=> 'checkbox',
			'std'		=> true
		),

		'pls_rp_hide_date' => array(
			'name'		=> __( 'Post Date', 'newsplus' ),
			'label'		=> __( 'Hide post date', 'newsplus' ),
			'id'		=> 'pls_rp_hide_date',
			'type'		=> 'checkbox',
			'std'		=> true
		),

		'pls_rp_hide_author' => array(
			'name'		=> __( 'Author link', 'newsplus' ),
			'label'		=> __( 'Hide author link', 'newsplus' ),
			'id'		=> 'pls_rp_hide_author',
			'type'		=> 'checkbox',
			'std'		=> true
		),

		'pls_rp_show_avatar' => array(
			'name'		=> __( 'Author Avatar', 'newsplus' ),
			'label'		=> __( 'Show author avatar', 'newsplus' ),
			'id'		=> 'pls_rp_show_avatar',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_rp_hide_excerpt' => array(
			'name'		=> __( 'Excerpt', 'newsplus' ),
			'label'		=> __( 'Hide post excerpt', 'newsplus' ),
			'id'		=> 'pls_rp_hide_excerpt',
			'type'		=> 'checkbox',
			'std'		=> true
		),

		'pls_rp_hide_comments' => array(
			'name'		=> __( 'Comments link', 'newsplus' ),
			'label'		=> __( 'Hide comments link', 'newsplus' ),
			'id'		=> 'pls_rp_hide_comments',
			'type'		=> 'checkbox',
			'std'		=> true
		),

		array(
			'name'		=> __( 'Social Sharing Counters Settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_ss_sharing' => array(
			'name'		=> __( 'Social sharing counters', 'newsplus' ),
			'label'		=> __( 'Show social sharing counters on single posts', 'newsplus' ),
			'id'		=> 'pls_ss_sharing',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_ss_fb' => array(
			'name'		=> __( 'Facebook', 'newsplus' ),
			'label'		=> __( 'Enable Facebook Like button', 'newsplus' ),
			'id'		=> 'pls_ss_fb',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_ss_tw' => array(
			'name'		=> __( 'Twitter', 'newsplus' ),
			'label'		=> __( 'Enable Twitter button', 'newsplus' ),
			'id'		=> 'pls_ss_tw',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_ss_tw_usrname' => array(
			'name'		=> __( 'Twitter Username (optional)', 'newsplus' ),
			'desc'		=> __( 'Write your twitter username without @', 'newsplus' ),
			'id'		=> 'pls_ss_tw_usrname',
			'std'		=> '',
			'type'		=> 'text'
		),

		'pls_ss_gp' => array(
			'name'		=> __( 'Google Plus', 'newsplus' ),
			'label'		=> __( 'Enable Google Plus button', 'newsplus' ),
			'id'		=> 'pls_ss_gp',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_ss_pint' => array(
			'name'		=> __( 'Pinterest', 'newsplus' ),
			'label'		=> __( 'Enable Pinterest button.', 'newsplus' ),
			'id'		=> 'pls_ss_pint',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_ss_ln' => array(
			'name'		=> __( 'LinkedIn', 'newsplus' ),
			'label'		=> __( 'Enable LinkedIn button.', 'newsplus' ),
			'id'		=> 'pls_ss_ln',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_ss_vk' => array(
			'name'		=> __( 'VK', 'newsplus' ),
			'label'		=> __( 'Enable VK button.', 'newsplus' ),
			'id'		=> 'pls_ss_vk',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_ss_yandex' => array(
			'name'		=> __( 'Yandex', 'newsplus' ),
			'label'		=> __( 'Enable Yandex button.', 'newsplus' ),
			'id'		=> 'pls_ss_yandex',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_ss_reddit' => array(
			'name'		=> __( 'Reddit', 'newsplus' ),
			'label'		=> __( 'Enable Reddit button.', 'newsplus' ),
			'id'		=> 'pls_ss_reddit',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		array(
			'name'		=> __( 'Social sharing buttons settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_show_social_btns' => array(
			'name'		=> __( 'Social share buttons', 'newsplus' ),
			'label'		=> __( 'Show social sharing buttons on single posts', 'newsplus' ),
			'id'		=> 'pls_show_social_btns',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_social_sticky' => array(
			'name'		=> __( 'Sticky buttons on mobile', 'newsplus' ),
			'label'		=> __( 'Make social share buttons sticky on mobile', 'newsplus' ),
			'id'		=> 'pls_social_sticky',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_social_btns' => array(
			'name'		=> __( 'Buttons to show', 'newsplus' ),
			'desc'		=> __( 'Select social buttons to show on single posts.', 'newsplus' ),
			'id'		=> 'pls_social_btns',
			'std'		=> '',
			'type'		=> 'multiselect',
			'options'	=> array(
							'Twitter' => 'twitter',
							'Facebook' => 'facebook',
							'Whatsapp' => 'whatsapp',
							'GooglePlus' => 'googleplus',
							'LinkedIn' => 'linkedin',
							'Pinterest' => 'pinterest',
							'VKOntakte' => 'vkontakte',
							'Email' => 'email',
							'Print' => 'print',
							'Reddit' => 'reddit'
						)
		),

		array(
			'name'		=> __( 'Global Single Post Advertisements', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_ad_above' => array(
			'name'		=> __( 'Advertisement above the post', 'newsplus' ),
			'desc'		=> __( 'Enter custom HTML or advertisement code that should appear above the post. Short codes are supported. The markup used here will apply to all posts globally.<br/>You can override or hide this ad on individual posts.', 'newsplus' ),
			'id'		=> 'pls_ad_above',
			'std'		=> '',
			'type'		=> 'textarea'
		),

		'pls_ad_below' => array(
			'name'		=> __( 'Advertisement below the post', 'newsplus' ),
			'desc'		=> __( 'Enter custom HTML or advertisement code that should appear below the post. Short codes are supported. The markup used here will apply to all posts globally.<br/>You can override or hide this ad on individual posts.', 'newsplus' ),
			'id'		=> 'pls_ad_below',
			'std'		=> '',
			'type'		=> 'textarea'
		),

		array( 'type' 	=> 'tabbed_end' ),

		array(
			'type'		=> 'tabbed_start',
			'id'		=> 'pls_contact'
		),

		array(
			'name'		=> __( 'Contact page template settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_email' => array(
			'name'		=> __( 'Contact e-mail', 'newsplus' ),
			'desc'		=> __( 'Enter an e-mail address to which mail should be received from contact page. If left blank, your blog admin email is used.', 'newsplus' ),
			'id'		=> 'pls_email',
			'std'		=> '',
			'type'		=> 'text'
		),

		'pls_google_map' => array(
			'name'		=> __( 'Contact Page custom Markup<br/>(Can be used for Google Maps)', 'newsplus' ),
			'desc'		=> __( 'Visit maps.google.com and copy your map location iFrame code. Paste it here. This will be shown on contact page template.<br/>Tip: You can also use any custom markup or HTML here instead of Google Maps.', 'newsplus' ),
			'id'		=> 'pls_google_map',
			'std'		=> '',
			'type'		=> 'textarea'
		),

		'pls_success_msg' => array(
			'name'		=> __( 'Mail Sent Message:', 'newsplus' ),
			'desc'		=> __( 'Enter a message that should be displayed when the mail is successfully sent.', 'newsplus' ),
			'id'		=> 'pls_success_msg',
			'std'		=> __( '<h4>Thank You! Your message has been sent.</h4>', 'newsplus' ),
			'type'		=> 'textarea'
		),

		array( 'type'	=> 'tabbed_end' ),

		array(
			'type'		=> 'tabbed_start',
			'id'		=> 'pls_footer'
		),

		array(
			'name'		=> __( 'Footer settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_footer_cols' => array(
			'name'		=> __( 'Footer columns', 'newsplus' ),
			'desc'		=> __( 'Select number of columns in secondary widget area.', 'newsplus' ),
			'id'		=> 'pls_footer_cols',
			'std'		=> '4',
			'type'		=> 'select',
			'options'	=> array( '1','2','3','4','5','6')
		),

		'pls_footer_left' => array(
			'name'		=> __( 'Custom Footer Text (Left):', 'newsplus' ),
			'desc'		=> __( 'Enter custom text for left side of the footer. You can use <code>HTML</code> here.', 'newsplus' ),
			'id'		=> 'pls_footer_left',
			'std'		=> '&copy; ' . date('Y') . ' CompanyName. All rights reserved.',
			'type'		=> 'textarea'
		),

		'pls_footer_right' => array(
			'name'		=> __( 'Custom Footer Text (Right):', 'newsplus' ),
			'desc'		=> __( 'Enter custom text for right side of the footer. You can use <code>HTML</code> here.', 'newsplus' ),
			'id'		=> 'pls_footer_right',
			'std'		=> 'Optional footer notes.',
			'type'		=> 'textarea'
		),

		array( 'type'	=> 'tabbed_end' ),

		array(
			'type'		=> 'tabbed_start',
			'id'		=> 'pls_custom_font'
		),

		array(
			'name'		=> __( 'Custom Font Settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_disable_custom_font' => array(
			'name'		=> __( 'Disable Google fonts', 'newsplus' ),
			'label'		=> __( 'Disable custom Google font', 'newsplus' ),
			'id'		=> 'pls_disable_custom_font',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		'pls_global_font' => array(
			'name'		=> __( 'Global font family', 'newsplus' ),
			'desc'		=> __( 'Select global font family for entire site.', 'newsplus' ),
			'id'		=> 'pls_global_font',
			'std'		=> '',
			'type'		=> 'select',
			'options'	=> $newsplus_google_font_list
		),

		'pls_heading_font' => array(
			'name'		=> __( 'Heading font family', 'newsplus' ),
			'desc'		=> __( 'Select font family for headings.', 'newsplus' ),
			'id'		=> 'pls_heading_font',
			'std'		=> '',
			'type'		=> 'select',
			'options'	=> $newsplus_google_font_list
		),

		'pls_menu_font' => array(
			'name'		=> __( 'Navigation menu font family', 'newsplus' ),
			'desc'		=> __( 'Select font family for main navigation.', 'newsplus' ),
			'id'		=> 'pls_menu_font',
			'std'		=> '',
			'type'		=> 'select',
			'options'	=> $newsplus_google_font_list
		),

		'pls_font_subset' => array(
			'name'		=> __( 'Subsets', 'newsplus' ),
			'desc'		=> __( 'Enter Google font subsets values, separated by comma. E.g. <code>cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese</code>', 'newsplus' ),
			'id'		=> 'pls_font_subset',
			'std'		=> 'latin,latin-ext',
			'type'		=> 'textarea'
		),

		'pls_font_family' => array(
			'name'		=> __( 'Font family (Deprecated)', 'newsplus' ),
			'desc'		=> __( 'This option is deprecated. Use Google fonts from the options above.', 'newsplus' ),
			'id'		=> 'pls_font_family',
			'std'		=> '',
			'type'		=> 'textarea'
		),

		'pls_user_css' => array(
			'name'		=> __( 'Additional CSS', 'newsplus' ),
			'desc'		=> __( 'You can add any custom CSS in this field, but it is strongly recommended to use child theme\'s style.css for any custom CSS changes. Example for font CSS:<br/> <pre>body.custom-font-enabled {<br/>  font-family: \'Open Sans\';<br/>}</pre>', 'newsplus' ),
			'id'		=> 'pls_user_css',
			'std'		=> '',
			'type'		=> 'textarea'
		),

		array( 'type'	=> 'tabbed_end' ),

		array(
			'type'		=> 'tabbed_start',
			'id'		=> 'pls_image_sizes'
		),

		array(
			'type'		=> 'subdescription',
			'desc'		=> __( 'Use this section for specifying custom image sizes for archives. You can set width, height and crop mode. For auto height, use 9999 in height and uncheck the hard crop mode.', 'newsplus' ),
		),


		array(
			'name'		=> __( 'Grid style blog images', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'grid_width' => array(
			'name'		=> __( 'Width', 'newsplus' ),
			'desc'		=> __( 'Enter a width for one columnar grid images.', 'newsplus' ),
			'id'		=> 'grid_width',
			'std'		=> '640',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'grid_height' => array(
			'name'		=> __( 'Height', 'newsplus' ),
			'desc'		=> __( 'Enter a height for one columnar grid images.', 'newsplus' ),
			'id'		=> 'grid_height',
			'std'		=> '360',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'grid_quality' => array(
			'name'		=> __( 'Image quality', 'newsplus' ),
			'desc'		=> __( 'Provide image quality in range [1-100]. E.g. 80', 'newsplus' ),
			'id'		=> 'grid_quality',
			'std'		=> '80',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'grid_crop' => array(
			'name'		=> __( 'Hard Crop', 'newsplus' ),
			'label'		=> __( 'Enable hard crop', 'newsplus' ),
			'id'		=> 'grid_crop',
			'type'		=> 'checkbox',
			'std'		=> false
		),


		array(
			'name'		=> __( 'Classic style blog images', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'classic_width' => array(
			'name'		=> __( 'Width', 'newsplus' ),
			'desc'		=> __( 'Enter a width for list style big images.', 'newsplus' ),
			'id'		=> 'classic_width',
			'std'		=> '960',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'classic_height' => array(
			'name'		=> __( 'Height', 'newsplus' ),
			'desc'		=> __( 'Enter a height for list style big images.', 'newsplus' ),
			'id'		=> 'classic_height',
			'std'		=> '540',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'classic_quality' => array(
			'name'		=> __( 'Image quality', 'newsplus' ),
			'desc'		=> __( 'Provide image quality in range [1-100]. E.g. 80', 'newsplus' ),
			'id'		=> 'classic_quality',
			'std'		=> '80',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'classic_crop' => array(
			'name'		=> __( 'Hard Crop', 'newsplus' ),
			'label'		=> __( 'Enable hard crop', 'newsplus' ),
			'id'		=> 'classic_crop',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		array(
			'name'		=> __( 'List style blog images', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'list_big_width' => array(
			'name'		=> __( 'Width', 'newsplus' ),
			'desc'		=> __( 'Enter a width for list style big images.', 'newsplus' ),
			'id'		=> 'list_big_width',
			'std'		=> '640',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'list_big_height' => array(
			'name'		=> __( 'Height', 'newsplus' ),
			'desc'		=> __( 'Enter a height for list style big images.', 'newsplus' ),
			'id'		=> 'list_big_height',
			'std'		=> '360',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'list_big_quality' => array(
			'name'		=> __( 'Image quality', 'newsplus' ),
			'desc'		=> __( 'Provide image quality in range [1-100]. E.g. 80', 'newsplus' ),
			'id'		=> 'list_big_quality',
			'std'		=> '80',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'list_big_crop' => array(
			'name'		=> __( 'Hard Crop', 'newsplus' ),
			'label'		=> __( 'Enable hard crop', 'newsplus' ),
			'id'		=> 'list_big_crop',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		array(
			'name'		=> __( 'Related Posts Images', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'rp_width' => array(
			'name'		=> __( 'Width', 'newsplus' ),
			'desc'		=> __( 'Enter a width for related posts images on Single post.', 'newsplus' ),
			'id'		=> 'rp_width',
			'std'		=> '400',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'rp_height' => array(
			'name'		=> __( 'Height', 'newsplus' ),
			'desc'		=> __( 'Enter a height for related posts images on Single post.', 'newsplus' ),
			'id'		=> 'rp_height',
			'std'		=> '225',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'rp_quality' => array(
			'name'		=> __( 'Image quality', 'newsplus' ),
			'desc'		=> __( 'Provide image quality in range [1-100]. E.g. 80', 'newsplus' ),
			'id'		=> 'rp_quality',
			'std'		=> '80',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'rp_crop' => array(
			'name'		=> __( 'Crop', 'newsplus' ),
			'label'		=> __( 'Enable hard crop', 'newsplus' ),
			'id'		=> 'rp_crop',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		array(
			'name'		=> __( 'Single Post Image', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'sng_width' => array(
			'name'		=> __( 'Width', 'newsplus' ),
			'desc'		=> __( 'Enter a width for single post featured image.', 'newsplus' ),
			'id'		=> 'sng_width',
			'std'		=> '960',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'sng_height' => array(
			'name'		=> __( 'Height', 'newsplus' ),
			'desc'		=> __( 'Enter a height for single post featured image.', 'newsplus' ),
			'id'		=> 'sng_height',
			'std'		=> '540',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'sng_quality' => array(
			'name'		=> __( 'Image quality', 'newsplus' ),
			'desc'		=> __( 'Provide image quality in range [1-100]. E.g. 80', 'newsplus' ),
			'id'		=> 'sng_quality',
			'std'		=> '80',
			'type'		=> 'number',
			'min'		=> '',
			'max'		=> ''
		),

		'sng_crop' => array(
			'name'		=> __( 'Hard Crop', 'newsplus' ),
			'label'		=> __( 'Enable hard crop', 'newsplus' ),
			'id'		=> 'sng_crop',
			'type'		=> 'checkbox',
			'std'		=> false
		),

		array( 'type'	=> 'tabbed_end' ),

		array(
			'type'		=> 'tabbed_start',
			'id'		=> 'pls_custom_menus'
		),

		array(
			'name'		=> __( 'Custom HTML menus', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_html_main_menu' => array(
			'name'		=> __( 'HTML Primary Menu', 'newsplus' ),
			'desc'		=> __( 'Use custom HTML menu markup in this field. It reduces load time by 0.2s as compared to WP menu. You can copy source code of main menu from front end and paste here. The code should include parent ul list and it\'s children.', 'newsplus' ),
			'id'		=> 'pls_html_main_menu',
			'type'		=> 'textarea',
			'std'		=> false
		),

		'pls_html_top_menu' => array(
			'name'		=> __( 'HTML Top Menu', 'newsplus' ),
			'desc'		=> __( 'Use custom HTML menu markup in this field. It reduces load time by 0.2s as compared to WP menu. You can copy source code of main menu from front end and paste here. The code should include parent ul list and it\'s children.', 'newsplus' ),
			'id'		=> 'pls_html_top_menu',
			'type'		=> 'textarea',
			'std'		=> false
		),

		array( 'type'	=> 'tabbed_end' ),

		array(
			'type'		=> 'tabbed_start',
			'id'		=> 'pls_import_export'
		),

		array(
			'name'		=> __( 'Import or export theme settings', 'newsplus' ),
			'type'		=> 'subheading'
		),

		'pls_curr_settings' => array(
			'name'		=> __( 'Your current settings', 'newsplus' ),
			'desc'		=> __( 'Copy contents of above textarea and save in a text file for keeping a backup of current settings. You can copy them from file again and paste inside the \'Import new settings\' textarea below.', 'newsplus' ),
			'id'		=> 'pls_curr_settings',
			'type'		=> 'export_textarea',
			'std'		=> false
		),

		'pls_new_settings' => array(
			'name'		=> __( 'Import new settings', 'newsplus' ),
			'desc'		=> __( 'Paste new settings inside this textarea. Then click on \'Save Settings\' and then click \'Update imported settings\' button. Once settings are updated, you can delete contents of this textarea.', 'newsplus' ),
			'id'		=> 'pls_new_settings',
			'type'		=> 'import_textarea',
			'std'		=> false
		),

		array( 'type'	=> 'tabbed_end' ),

		array( 'type' 	=> 'wrap_end' )
);

function newsplus_add_admin() {
	global $shortname, $newsplus_options;
	ob_start();
	if ( isset( $_GET['page'] ) && ( $_GET['page'] == basename(__FILE__) ) ) {

		// Nonce values
		$save_nonce		= isset( $_REQUEST['_np_save_settings_nonce'] ) ? $_REQUEST['_np_save_settings_nonce'] : '';
		$reset_nonce 	= isset( $_REQUEST['_np_reset_settings_nonce'] ) ? $_REQUEST['_np_reset_settings_nonce'] : '';
		$import_nonce 	= isset( $_REQUEST['_np_import_settings_nonce'] ) ? $_REQUEST['_np_import_settings_nonce'] : '';

		if ( isset( $_REQUEST['action'] ) && ( 'save' == $_REQUEST['action'] ) ) {
			if ( ! wp_verify_nonce( $save_nonce, 'save_settings' ) ) {
				print __( 'Sorry, your nonce did not verify.', 'newsplus' );
				exit;
			}

			else {
				foreach ( $newsplus_options as $value ) {
					if ( isset( $value['id'] ) ) {
						if ( isset( $_REQUEST[ $value['id'] ] ) ) {
							update_option( $value['id'], $_REQUEST[ $value['id'] ] );
						}
						else {
							delete_option( $value['id'] );
						}
					}
				}
				header( 'Location:themes.php?page=theme-admin-options.php&saved=true&_np_save_settings_nonce=' . $_REQUEST['_np_save_settings_nonce'] );
				die;
			}
		}
		elseif ( isset( $_REQUEST['action'] ) && ( 'reset' == $_REQUEST['action'] ) ) {

			if ( ! wp_verify_nonce( $reset_nonce, 'reset_settings' ) ) {
				print __( 'Sorry, your nonce did not verify.', 'newsplus' );
				exit;
			}
			else {
				foreach ( $newsplus_options as $value ) {
					if ( isset( $value['id'] ) && isset ( $value['std'] ) ) {
						delete_option( $value['id'] );
						update_option( $value['id'], $value['std'] );
					}
				}
				header( 'Location:themes.php?page=theme-admin-options.php&reset=true&_np_reset_settings_nonce=' . $_REQUEST['_np_reset_settings_nonce'] );
				die;
			}
		}

		elseif ( isset( $_REQUEST['action'] ) && ( 'import' == $_REQUEST['action'] ) ) {

			if ( ! wp_verify_nonce( $import_nonce, 'import_settings' ) ) {
				print __( 'Sorry, your nonce did not verify.', 'newsplus' );
				exit;
			}
			else {
				// Check if there are any settings to import
				if ( '' != get_option( 'pls_new_settings', '' ) ) {
					$new_settings = json_decode( stripslashes( get_option( 'pls_new_settings', '' ) ), true );
					if ( is_array( $new_settings ) ) {
						foreach ( $new_settings as $key => $value ) {
							if ( isset( $value['id'] ) && 'pls_new_settings' != $key ) {
								update_option( $key, $value['id'] );
							}
						}

					}

					header( 'Location:themes.php?page=theme-admin-options.php&import=true&_np_import_settings_nonce=' . $_REQUEST['_np_import_settings_nonce'] );
					die;

				}

				else {
					header( 'Location:themes.php?page=theme-admin-options.php&import=false&_np_import_settings_nonce=' . $_REQUEST['_np_import_settings_nonce'] );
					die;
				}
			}
		}
	}
	$hookname = add_theme_page( __( 'Theme Options', 'newsplus' ), __( 'Theme Options', 'newsplus' ), 'edit_theme_options', basename( __FILE__ ), 'newsplus_admin' );
	add_action( 'admin_print_scripts-' . $hookname, 'newsplus_admin_scripts' );
	ob_end_clean();
}
function newsplus_admin_scripts() {
	global $shortname, $newsplus_options;

	// Add the color picker css file
    wp_enqueue_style( 'wp-color-picker' );
	// Load scripts required by Theme Options page
	wp_enqueue_style( 'theme-admin-css', get_template_directory_uri() . '/css/admin.css', false, '', 'all' );
	// Include our custom jQuery file with WordPress Color Picker dependency
    wp_enqueue_script( 'theme-admin-js', get_template_directory_uri() . '/js/admin.js', array( 'wp-color-picker' ), false, true );

	// WP media uplaoder
	if ( ! did_action( 'wp_enqueue_media' ) )
		wp_enqueue_media();

	// Localize text strings and variables used in media uploader code
	$localization = array(
		'media_upload_text' => esc_html__( 'Select or upload image' , 'newsplus' ),
		'media_button_text' => esc_html__( 'Use image' , 'newsplus' ),
	);

	wp_localize_script( 'theme-admin-js', 'np_localize', $localization );
}

function newsplus_theme_options_notices() {
	// Get nonce values
	$save_nonce = isset( $_REQUEST['_np_save_settings_nonce'] ) ? $_REQUEST['_np_save_settings_nonce'] : '';
	$reset_nonce = isset( $_REQUEST['_np_reset_settings_nonce'] ) ? $_REQUEST['_np_reset_settings_nonce'] : '';
	$import_nonce = isset( $_REQUEST['_np_import_settings_nonce'] ) ? $_REQUEST['_np_import_settings_nonce'] : '';

	if ( isset( $_REQUEST['saved'] ) && $_REQUEST['saved'] ) {
		?>
		<div class="notice notice-success is-dismissible">
			<p><?php _e( 'Theme settings saved.', 'newsplus' ); ?></p>
		</div>
		<?php
	}

    if ( isset( $_REQUEST['reset'] ) && $_REQUEST['reset'] ) { ?>
		<div class="notice notice-success is-dismissible">
            <p><?php _e( 'Theme settings reset.', 'newsplus' ); ?></p>
        </div>
	<?php }

	 if ( isset( $_REQUEST['import'] ) && $_REQUEST['import'] ) {
		$new_settings = json_decode( stripslashes( get_option( 'pls_new_settings', '' ) ), true );
		if ( is_array( $new_settings ) ) {
			?>
			<div class="notice notice-success is-dismissible">
                <p> <?php _e( 'Theme settings imported and updated successfully.', 'newsplus' ); ?></p>
			</div>
			<?php
		}
		else {
			?>
			<div class="notice notice-error is-dismissible">
                <p> <?php _e( 'Unable to import settings. Either import field is empty or the data is invalid.', 'newsplus' ); ?></p>
			</div>
			<?php
		}
	}
}
add_action( 'admin_notices', 'newsplus_theme_options_notices' );

function newsplus_admin() {
    global $shortname, $newsplus_options;
	?>
    <div class="wrap">
    <div id="icon-themes" class="icon32"></div>
        <h2 class="settings-title ss-settings-title"><?php _e( 'Theme Options', 'newsplus' ); ?></h2>
        <form method="post">
		<?php foreach ( $newsplus_options as $value ) {
                switch ( $value['type'] ) {

                    case 'wrap_start': ?>
                    <div class="ss_wrap">
                    <?php break;

                    case 'wrap_end': ?>
                    </div>
                    <?php break;

                    case 'tabs_start': ?>
                    <nav class="nav-tab-wrapper ss-nav-tab-wrapper">
                    <?php break;

                    case 'tabs_end': ?>
                    </nav>
                    <?php break;

                    case 'tabbed_start': ?>
                    <div class="tabbed" id="<?php echo esc_attr( $value['id'] ); ?>">
                    <?php break;

                    case 'tabbed_end': ?>
                    </div>
                    <?php break;

                    case 'heading': ?>
                    <a class="nav-tab" href="#<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_attr( $value['name'] ); ?></a>
                    <?php break;

                    case 'subheading': ?>
                    <h2><?php echo esc_attr( $value['name'] ); ?></h2>
                    <?php break;

                    case 'subdescription': ?>
                    <p><?php echo esc_attr( $value['desc'] ); ?></p>
                    <?php break;

                    case 'select': ?>
                    <ul class="item_row">
                        <li class="left_col"><?php echo esc_attr( $value['name'] ); ?></li>
                        <li class="right_col">
                            <select name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>">
                                <?php


							foreach ( $value['options'] as $index => $data ) {

								if ( is_numeric( $index ) && ( is_string( $data ) || is_numeric( $data ) ) ) {
									$option_label = $data;
									$option_value = $data;
								} elseif ( is_numeric( $index ) && is_array( $data ) ) {
									$option_label = isset( $data['label'] ) ? $data['label'] : array_pop( $data );
									$option_value = isset( $data['value'] ) ? $data['value'] : array_pop( $data );
								} else {
									$option_value = $data;
									$option_label = $index;
								}
								$selected = '';
								//$option_value_string = (string) $option_value;
								//$value_string = (string) get_option( $value['id'] );
								if ( get_option( $value['id'] ) && get_option( $value['id'] ) == $option_value ) {
									$selected = ' selected="selected"';
								}

								echo '<option value="' . esc_attr( $option_value ) . '"' . $selected . '>'
										   . htmlspecialchars( $option_label ) . '</option>';
							}
							?>

                            </select>
                           <?php if ( isset( $value['desc'] ) ) { echo '<p class="description">' . $value['desc'] . '</p>'; } ?>
                        </li>
                    </ul>
                    <?php break;

					case 'multiselect' : ?>
                        <ul class="item_row">
                            <li class="left_col"><?php echo esc_attr( $value['name'] ); ?></li>
                            <li class="right_col">

						<?php
                        echo '<select class="multiselect" name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" size="5">';
						$value_arr = ( null !== get_option( $value['id'] ) ) ? get_option( $value['id'] ) : array();
						if ( ! empty( $value['options'] ) ) {

							foreach ( $value['options'] as $index => $data ) {

								if ( is_numeric( $index ) && ( is_string( $data ) || is_numeric( $data ) ) ) {
									$option_label = $data;
									$option_value = $data;
								} elseif ( is_numeric( $index ) && is_array( $data ) ) {
									$option_label = isset( $data['label'] ) ? $data['label'] : array_pop( $data );
									$option_value = isset( $data['value'] ) ? $data['value'] : array_pop( $data );
								} else {
									$option_value = $data;
									$option_label = $index;
								}
								$selected = '';
								$option_value_string = (string) $option_value;
								//$value_string = (string) get_option( $value['id'] );
								if ( is_array( $value_arr ) && in_array( $data, $value_arr ) ) {
									$selected = ' selected="selected"';
								}

								echo '<option value="' . esc_attr( $option_value ) . '"' . $selected . '>'
										   . htmlspecialchars( $option_label ) . '</option>';
							}
						}
						echo '</select>';
						if ( isset( $value['desc'] ) ) { echo '<p class="description">' . $value['desc'] . '</p>'; } ?>
                        </li>
                    </ul>

					<?php
                    break;

                    case 'text':
                    ?>
                    <ul class="item_row">
                        <li class="left_col"><?php echo esc_attr( $value['name'] ); ?></li>
                        <li class="right_col">
                            <input class="regular-text" name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" type="<?php echo esc_attr( $value['type'] ); ?>" value="<?php if ( get_option( $value['id'] ) != $value['std'] ) { echo get_option( $value['id'] ); } else { echo esc_attr( $value['std'] ); } ?>" />
                            <?php if ( isset( $value['desc'] ) ) { echo '<p class="description">' . $value['desc'] . '</p>'; } ?>
                        </li>
                    </ul>
                    <?php break;

                    case 'color-picker':
                    ?>
                    <ul class="item_row">
                        <li class="left_col"><?php echo esc_attr( $value['name'] ); ?></li>
                        <li class="right_col">
                            <input class="regular-text np-color-picker" name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" type="text" value="<?php if ( get_option( $value['id'] ) != $value['std'] ) { echo get_option( $value['id'] ); } else { echo esc_attr( $value['std'] ); } ?>" />
                            <?php if ( isset( $value['desc'] ) ) { echo '<p class="description">' . $value['desc'] . '</p>'; } ?>
                        </li>
                    </ul>
                    <?php break;

					case 'number':
                    ?>
                    <ul class="item_row">
                        <li class="left_col"><?php echo esc_attr( $value['name'] ); ?></li>
                        <li class="right_col">
                            <input class="regular-text" name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" type="number" min="<?php echo esc_attr( $value['min'] ); ?>" max="<?php echo esc_attr( $value['max'] ); ?>" value="<?php if ( get_option( $value['id'] ) != $value['std'] ) { echo get_option( $value['id'] ); } else { echo esc_attr( $value['std'] ); } ?>" />
                            <?php if ( isset( $value['desc'] ) ) { echo '<p class="description">' . $value['desc'] . '</p>'; } ?>
                        </li>
                    </ul>
                    <?php break;

                    case 'textarea':
                    ?>
                    <ul class="item_row">
                        <li class="left_col"><?php echo esc_attr( $value['name'] ); ?></li>
                        <li class="right_col">
                            <textarea class="code" name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" cols="30" rows="6"><?php if ( get_option( $value['id'] ) != $value['std'] ) { echo stripslashes( get_option( $value['id'] ) ); } else { echo esc_attr( $value['std'] ); } ?></textarea>
                        <?php if ( isset( $value['desc'] ) ) { echo '<p class="description">' . $value['desc'] . '</p>'; } ?>
                        </li>
                    </ul>
                    <?php break;

                    case "checkbox":
                    ?>
                    <ul class="item_row">
                        <li class="left_col"><?php echo esc_attr( $value['name'] ); ?></li>
                        <li class="right_col">
                            <?php
							$label = isset( $value['label'] ) ? $value['label'] : '';
							if ( get_option( $value['id'] ) ){ $checked = 'checked="checked"'; } else { $checked = ''; } ?>
                            <label for="<?php echo esc_attr( $value['id'] ); ?>"><input type="checkbox" name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" value="true" <?php echo esc_attr( $checked ); ?> /><?php echo ' ' . $label; ?></label>
                        	<?php if ( isset( $value['desc'] ) ) { echo '<p class="description">' . $value['desc'] . '</p>'; } ?>
                        </li>
                    </ul>
                    <?php break;

                    case 'export_textarea':
					?>
						<ul class="item_row">
							<li class="left_col"><?php echo esc_attr( $value['name'] ); ?></li>
							<li class="right_col">
								<textarea class="code" name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" cols="100" rows="10" onclick="this.focus();this.select()" readonly ><?php echo newsplus_current_settings(); ?></textarea>
							<?php if ( isset( $value['desc'] ) ) { echo '<p class="description">' . $value['desc'] . '</p>'; } ?>
							</li>
						</ul>
                    <?php break;

                    case 'import_textarea':
					?>
						<ul class="item_row">
							<li class="left_col"><?php echo esc_attr( $value['name'] ); ?></li>
							<li class="right_col">
								 <textarea class="code" name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" cols="100" rows="10"><?php if ( get_option( $value['id'] ) != $value['std'] ) { echo stripslashes( get_option( $value['id'] ) ); } else { echo stripslashes( $value['std'] ); } ?></textarea>
							<?php if ( isset( $value['desc'] ) ) { echo '<p class="description">' . $value['desc'] . '</p>'; } ?>
							</li>
						</ul>
                     <?php
                     break;

					 case 'image_uploader' :
					 ?>
 						<ul class="item_row">
							<li class="left_col"><?php echo esc_attr( $value['name'] ); ?></li>
							<li class="right_col">
                                <input name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" class="code image-url" type="text" size="36" value="<?php if ( get_option( $value['id'] ) != $value['std'] ) { echo get_option( $value['id'] ); } else { echo esc_attr( $value['std'] ); } ?>" />
                                <input class="upload_image_btn button button-primary<?php if ( get_option( $value['id'] ) ) { echo ' hidden'; } ?>" type="button" value="Upload Image" /> <input class="button delete_image_btn<?php if ( ! get_option( $value['id'] )  ) { echo ' hidden'; } ?>" type="button" value="<?php esc_attr_e( 'Remove image', 'newsplus' ); ?>" />
                                <?php if ( isset( $value['desc'] ) ) { echo '<p class="description">' . $value['desc'] . '</p>'; } ?>
                            </li>
                        </ul>

					 <?php
                     break;
				}
			}
			?>
			<div class="submit-row">
				<input class="button button-primary" name="save" type="submit" value="<?php _e( 'Save Settings', 'newsplus' ); ?>" />
                <input type="hidden" name="action" value="save" />
                <?php wp_nonce_field( 'save_settings', '_np_save_settings_nonce', false ); ?>
			</div>
        </form>
        <div class="submit-row reset-row">
            <form method="post">
                <input class="button" name="reset" type="submit" value="<?php _e( 'Reset all Settings', 'newsplus' ); ?>" />
                <input type="hidden" name="action" value="reset" />
                <?php wp_nonce_field( 'reset_settings', '_np_reset_settings_nonce', false ); ?>
            </form>
        </div>

        <div class="submit-row reset-row">
            <form method="post">
                <input class="button" name="import" type="submit" value="<?php _e( 'Update imported settings', 'newsplus' ); ?>" />
                <input type="hidden" name="action" value="import" />
				<?php wp_nonce_field( 'import_settings', '_np_import_settings_nonce', false ); ?>
            </form>
        </div>
    </div> <!-- .wrap -->
<?php }

function newsplus_current_settings() {
	global $newsplus_options;
	$new = array();

	foreach ( $newsplus_options as $key => $value ) {
		if( isset( $value['id'] ) && isset( $value['std'] ) && 'pls_curr_settings' != $key && 'pls_new_settings' != $key   ) {
			if ( get_option( $value['id'] ) === FALSE )
				$new[ $key ]['id'] = $value['std'];
			else
				$new[ $key ]['id'] = get_option( $value['id'] );
		}
	}

	return json_encode( $new, JSON_FORCE_OBJECT );
}
add_action( 'admin_menu', 'newsplus_add_admin' ); ?>