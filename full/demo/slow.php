<?php

const WEBSITE_TITLE = 'Redirect When Blocked Full Edition Demo Website Slow Page';

require 'rwb/RedirectWhenBlockedFull.inc';

$alt_url_bases = array(
	'http://rwb.greatfire.org/redirect-when-blocked/full/demo/',
	'https://d3059gkikm7ixv.cloudfront.net/redirect-when-blocked/full/demo/',
	'https://d3u4seijlqumgj.cloudfront.net/redirect-when-blocked/full/demo/',
	'https://d20fpcnyklk6h4.cloudfront.net/redirect-when-blocked/full/demo/'
);

new RedirectWhenBlockedFull($alt_url_bases, WEBSITE_TITLE);

// Simulate a slow connection.
sleep(rand(2, 6));
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php print WEBSITE_TITLE ?></title>
</head>
<body>
	<h1><?php print WEBSITE_TITLE ?></h1>
	<p>Current time: <?php print date('Y-m-d H:i:s') ?></p>
	<ul>
		<li><a href="index.php">Index</a></li>
		<li><a href="slow.php">Slow Page</a></li>
	</ul>

	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec
		auctor euismod viverra. Nam hendrerit eros nulla, nec bibendum velit
		accumsan sed. Nam a porta mi. Phasellus pharetra, neque at facilisis
		dapibus, sem ipsum tempus tortor, id elementum elit nibh a purus. In
		vehicula tellus metus, sit amet porttitor augue bibendum in. Quisque
		eu interdum diam. Maecenas iaculis laoreet libero, a suscipit tortor
		vulputate id. Ut consequat mi orci, sit amet maximus magna hendrerit
		congue. Aliquam condimentum nibh efficitur nulla congue, ac rhoncus
		dolor suscipit. Praesent iaculis consequat ipsum a tempor. Integer
		aliquam est sit amet purus scelerisque tristique. Aenean ante justo,
		vestibulum id mollis in, blandit non metus. Nunc ac arcu bibendum,
		egestas ante in, ultrices sem. Sed ac nisi vitae neque eleifend
		convallis. Aenean quis malesuada urna. Donec elementum eget arcu
		blandit convallis.</p>
	<p>
		<img src="sample-image.png" width="200" />
	</p>
	<p>Vivamus eu mauris placerat, euismod risus eget, fermentum erat. Cras
		justo quam, hendrerit quis turpis cursus, sagittis fermentum purus.
		Fusce sit amet orci arcu. Aenean venenatis, ante et vulputate pretium,
		sapien nunc molestie mi, sit amet lacinia mi odio ut mauris. Aliquam
		quam lacus, elementum porttitor lobortis a, luctus ac libero.
		Curabitur eleifend dapibus volutpat. Nulla dignissim ullamcorper odio,
		sit amet placerat elit condimentum ac. Etiam aliquet est nunc,
		elementum porta odio molestie eget. Suspendisse semper auctor diam eu
		consequat. Suspendisse enim nulla, tincidunt vel vestibulum quis,
		mattis ut enim. In laoreet tempor ipsum, id tristique ante iaculis ac.
		Donec laoreet ornare libero vel aliquet. Nulla ut feugiat erat, a
		cursus sem. Proin feugiat feugiat enim ac lobortis. Duis feugiat arcu
		et mauris rutrum lobortis.</p>
	<p>Aliquam euismod nisi vitae augue lobortis, quis ornare sem lacinia.
		Etiam venenatis, sem vitae gravida porta, nunc sapien interdum sem,
		non laoreet lectus risus a urna. Mauris eget tempor elit, non aliquet
		dui. Mauris vitae elit pellentesque, vulputate nunc in, hendrerit
		nisl. In in sem hendrerit nisi condimentum ultricies quis sed ante.
		Fusce nulla ligula, facilisis et orci vel, pharetra fermentum urna.
		Proin mollis auctor metus, eget cursus ex pellentesque imperdiet.
		Etiam ac velit non mi fermentum elementum. Nunc sem eros, varius vel
		dignissim id, efficitur ac risus. Maecenas malesuada varius augue,
		vitae viverra sem efficitur ut. Donec condimentum, magna quis bibendum
		porta, dolor sem ullamcorper lacus, eget porttitor enim nisi posuere
		lacus.</p>
	<p>Integer placerat eros a nunc condimentum consectetur. Aenean aliquet
		posuere justo, a malesuada lorem commodo a. Integer quis tellus
		lacinia, porta mi vitae, pellentesque massa. Nullam in ligula mi.
		Proin vel nulla sit amet massa molestie lacinia. Aliquam dapibus
		ornare commodo. Etiam auctor lobortis lorem, sit amet bibendum mi
		tincidunt ac.</p>
	<p>Praesent gravida ac nulla sed gravida. Aenean vehicula ex diam,
		lacinia rhoncus leo ullamcorper non. Ut lacinia vel quam a commodo.
		Sed volutpat leo ut sagittis posuere. Aliquam nec dui et mauris
		egestas elementum sed nec augue. Donec mauris metus, vestibulum et
		scelerisque tincidunt, pharetra sit amet justo. Aliquam sodales magna
		eget quam volutpat, eu fringilla nibh scelerisque. Proin et odio
		pharetra quam fermentum consequat. Sed ornare euismod turpis vitae
		aliquam. Aliquam posuere leo massa, eget egestas metus dapibus non.
		Aenean at tellus egestas, sodales diam et, pulvinar orci. Nulla
		facilisi. Duis id dapibus leo. Suspendisse molestie nisl in lectus
		vestibulum consequat. Cras diam ex, tempus porta maximus et, maximus
		nec velit.</p>
	<p>Duis imperdiet faucibus sapien, ac pellentesque neque gravida at.
		Nullam arcu sapien, commodo bibendum interdum quis, suscipit ac leo.
		Nulla non erat vel mi consequat facilisis. Integer fringilla erat in
		congue pharetra. Proin sed finibus turpis. In vel pharetra lectus.
		Etiam sagittis orci id purus egestas interdum. Praesent sapien ligula,
		euismod vel suscipit nec, malesuada vitae quam. Fusce nec mi sed ex
		varius auctor. Quisque efficitur pulvinar leo bibendum pharetra. In
		nec orci sit amet eros convallis facilisis. Quisque tellus quam,
		semper sit amet malesuada quis, tempus eget sapien. Fusce fringilla
		metus vitae placerat porttitor. Nunc rutrum quis tellus sed blandit.</p>
	<p>In hac habitasse platea dictumst. Nunc cursus diam sed diam
		imperdiet, vitae eleifend nibh mattis. Aliquam erat volutpat.
		Vestibulum at neque nisi. Pellentesque bibendum luctus sapien, quis
		varius urna convallis at. Pellentesque odio ex, aliquam at suscipit
		laoreet, viverra quis elit. Duis consectetur viverra purus quis
		dictum. Aenean a nisl mollis, vestibulum mauris sed, fermentum neque.
	</p>
	<p>Fusce aliquet risus a condimentum sollicitudin. Pellentesque
		fermentum massa at fermentum laoreet. Duis viverra volutpat posuere.
		Suspendisse lobortis suscipit libero et hendrerit. Nulla consequat
		rutrum purus ac rutrum. Curabitur laoreet laoreet justo id rutrum.
		Pellentesque eget dui vel nibh elementum condimentum id ut nisi.
		Mauris quis massa eu libero commodo imperdiet. Proin tristique ipsum
		at ligula sollicitudin, viverra pretium dui fermentum. Curabitur
		congue faucibus lacus eget lobortis. Donec maximus massa sit amet
		euismod feugiat. Quisque tincidunt suscipit ex, ut vulputate nulla
		tristique nec.</p>
	<p>Pellentesque venenatis lorem quis mattis fermentum. Nulla vel
		bibendum nunc. Mauris lacinia lobortis ligula, eget mattis tortor
		consequat ac. Proin elementum justo at fermentum fermentum. Nam non
		rutrum libero. Nam eget suscipit orci, in consequat purus. Vestibulum
		aliquam, urna vitae vehicula consequat, risus elit tincidunt diam, nec
		vehicula nunc leo eu urna. Duis sit amet mattis nibh. Morbi ac rhoncus
		lorem. Vestibulum pellentesque pellentesque nisl et aliquet. Mauris
		tellus velit, hendrerit in volutpat id, porttitor vitae magna. Nam
		molestie eros quis erat feugiat, at volutpat felis rhoncus. Donec
		efficitur nunc ante, eget fringilla eros eleifend sed. Cras
		scelerisque libero sit amet urna pellentesque, ac suscipit sapien
		faucibus.</p>
	<p>Sed et enim imperdiet, condimentum ex ac, iaculis dolor.
		Pellentesque eu iaculis nulla, eu bibendum neque. Aenean vestibulum
		ligula mauris. Pellentesque eu tincidunt elit. Fusce venenatis
		venenatis nisi, ac vehicula ipsum accumsan vel. In eu fermentum
		turpis. Cras efficitur turpis velit, ac varius magna viverra ut. Sed
		ultricies scelerisque urna vel malesuada. Nunc dignissim enim ut
		volutpat molestie. Fusce nec consectetur leo, sit amet hendrerit
		mauris. Morbi non est vel enim euismod ultrices. Aliquam erat
		volutpat. Nunc luctus turpis aliquam, condimentum nisl id, bibendum
		nunc. Aenean quis risus nunc. Nam sagittis ac purus vel vestibulum.
		Donec magna tellus, ultricies at bibendum vestibulum, luctus in
		sapien.</p>
</body>
</html>