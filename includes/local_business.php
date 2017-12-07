<?php /*
	Google Structured Data: https://developers.google.com/search/docs/data-types/local-businesses
	Debug Tool: https://search.google.com/structured-data/testing-tool/
*/ ?>

<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "LocalBusiness",
	"image": "http://www.example.com/image.jpg",
	"@id": "<?php echo get_bloginfo('wpurl'); ?>",
	"name": "<?php echo get_bloginfo('name'); ?>",
	"address": {
		"@type": "PostalAddress",
		"streetAddress": "Walnut St.",
		"addressLocality": "Cincinnati",
		"addressRegion": "OH",
		"postalCode": "45248",
		"addressCountry": "US"
	},
	"geo": {
		"@type": "GeoCoordinates",
		"latitude": 40.761293,
		"longitude": -73.982294
	},
	"url": "<?php echo get_bloginfo('wpurl'); ?>",
	"telephone": "+12122459600",
	"openingHoursSpecification": [
		{
			"@type": "OpeningHoursSpecification",
			"dayOfWeek": [
				"Monday",
				"Tuesday",
				"Wednesday",
				"Thursday",
				"Friday"
			  ],
			"opens": "11:30",
			"closes": "22:00"
		},
		{
			"@type": "OpeningHoursSpecification",
			"dayOfWeek": "Saturday",
			"opens": "16:00",
			"closes": "23:00"
		},
		{
			"@type": "OpeningHoursSpecification",
			"dayOfWeek": "Sunday",
			"opens": "16:00",
			"closes": "22:00"
		}
	]
}
</script>