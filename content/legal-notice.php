<?php 
	require('header.php'); 
	?>
<div class="col-lg-8 mx-auto p-3">
  <main>
  <h1>Legal Notice</h1>
<h4>Imprint</h4>
Yannik Ottens<br>
Kirchweg 151<br>
28201 Bremen<br>
Germany</p>

<h4>Contact</h4>
<p>Telephone: +49 15227751021<br>
E-Mail: info@fs-quiz.eu</p>

<h4>Responsible of content</h4>
<p>Yannik Ottens<br>
Kirchweg 151<br>
28201 Bremen<br>
Germany</p>
<hr>
<h1>Disclaimer</h1>
<h4>Liability for content</h4>
<p>The content of this site has been created with the greatest of care. I cannot, however, guarantee that the information in it is accurate, complete or up-to-date. As a service provider I am responsible under Section 6(1) of the German Media Services Inter-State Agreement and Section 8(1) of the German Teleservices Act for my own content on this site. Service providers are not however obliged to monitor third party information transmitted or stored on their site by them or to look for circumstances which may suggest a violation of the law. This does not affect my statutory obligations to remove or block the use of information. My liability in such cases shall however commence from the time I become aware of an actual violation. On becoming aware of such violations I shall remove this content immediately.</p>

<h4>Liability for links</h4>
<p>This website contains links to external third-party websites, over the content of which I have no control. I cannot, therefore, make any guarantees regarding this third-party content. Responsibility for the content of linked sites lies solely with the provider or operator of the site concerned. All linked sites were checked for possible violations of the law when they were linked to mine. At that time I was not aware of any content which may violate the law. However, I cannot be expected to monitor the content of linked sites on an ongoing basis unless I have reason to suspect a violation of the law. On becoming aware of such a violation I shall remove the respective link immediately.</p>

<h4>Data protection</h4>
<p>As a rule the use of this website is possible without providing any personally relevant data. Any provision of personal data (e.g. name, address or email addresses) occurs entirely on a voluntary basis. These data will not be provided to any third parties without the user's express approval. Be aware that the transmission of data via the internet (e.g. communication by email) is subject to security gaps. Complete protection of data from unauthorized access by third parties is not possible. The use of contact details published under the statutory requirement to provide acknowledgements by third parties for the purpose of the transmission of unsolicited advertising and informational material is expressly opposed. The site operator expressly reserves the right to take legal action against the unsolicited mailing of advertising information by way of spamming or similar.</p>

  </main>
<script>
getChangelog();
function getChangelog(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
			var r = "";
			var r = xmlHttp.responseText;
			document.getElementById("changelog").innerHTML = r;
		}
	}
	xmlHttp.open( "GET", "/php/getChangelog.php?type=1", true );
	xmlHttp.send( null );
}

</script>
  </div> 
<?php 
	require('footer.php');
?>