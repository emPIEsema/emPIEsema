<?php

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$products = [

1 => [
    "name" => "Nano Frivole",
    "price" => "₱129,000.00",
    "image" => "images/bag1.avif",
    "description" => "The Nano Frivole is crafted from premium materials with a timeless design that combines elegance, durability, and functionality. Its compact size makes it perfect for daily essentials while maintaining a luxurious appearance suitable for both casual and formal occasions."
],

2 => [
    "name" => "Avenue Slingbag PM",
    "price" => "₱183,000.00",
    "image" => "images/bag2.avif",

    "code" => "M2A354",

    "description" => "Compact and functional, the Avenue Slingbag is fashioned from Taurillon Monogram leather, a full-grain cowhide embossed with the iconic Monogram pattern. A stylish alternative to the classic backpack, this piece adjusts for left- or right-sided cross-body wear. The layout features a main zipped compartment, a front zipped pocket, and a discreet, triangular top pocket.",

    "dimensions" => "16 × 33 × 5.7 cm",

    "left_specs" => [
        "Black",
        "Taurillon Monogram cowhide leather",
        "Taurillon cowhide-leather trim",
        "Textile lining",
        "Silver-tone hardware for Forest Green / Matte black-color hardware for Black"
    ],

    "right_specs" => [
        "Main compartment with an inside pocket",
        "Front zipped pocket",
        "Small zipped pocket on top of the bag",
        "Strap: NOT REMOVABLE, ADJUSTABLE",
        "Strap drop: 27.5 cm",
        "Strap drop max: 48.7 cm"
    ],

    "made" => "Made in France, Spain or Italy or made in the U.S. of imported materials."
],

3 => [
    "name" => "District PM",
    "price" => "₱129,000.00",
    "image" => "images/bag3.avif",

    "code" => "M46253",

    "description" => "Made from masculine Monogram Eclipse canvas, the new District PM is a messenger-style bag with a contemporary design. An outside back zipped pocket gives quick access to essentials while the adjustable shoulder strap ensures comfortable carry. The strap is signed 'Louis Vuitton' and the lower front corner features black metallic LV initials.",

    "material" => "Monogram Eclipse",

    "dimensions" => "26 × 20 × 7 cm",

    "left_specs" => [
        "Monogram Eclipse coated canvas",
        "Cowhide-leather trim",
        "Textile lining",
        "Silver-color hardware",
        "Flap with magnetic closure",
        "Zipped back pocket"
    ],

    "right_specs" => [
        "2 inside flat pockets",
        "Inside front pocket",
        "Strap: NOT REMOVABLE, ADJUSTABLE",
        "Strap drop: 31.0 cm",
        "Strap drop max: 62.0 cm"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

4 => [
    "name" => "Discovery Bumbag PM",
    "price" => "₱129,000.00",
    "image" => "images/bag4.avif",

    "code" => "M46035",

    "description" => "Crafted from Monogram Eclipse canvas, the Discovery Bumbag offers the ideal mix of casual chic and modern functionality. With a body-friendly shape and adjustable belt, it can be worn around the waist, over the shoulder or slung stylishly across the chest. Zipped pockets, front and back, provide easy access to phone, cards and keys.",

    "material" => "Monogram Eclipse",

    "dimensions" => "44 × 15 × 9 cm",

    "left_specs" => [
        "Monogram Eclipse coated canvas",
        "Cowhide leather trim",
        "Textile lining",
        "Silver-color hardware",
        "Zip closure system",
        "Adjustable belt"
    ],

    "right_specs" => [
        "Outside front pocket",
        "Outside back flat pocket",
        "Strap: NOT REMOVABLE, ADJUSTABLE",
        "Strap drop: 26.0 cm",
        "Strap drop max: 42.0 cm"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

5 => [
    "name" => "Nil",
    "price" => "₱155,000.00",
    "image" => "images/bag5.avif",

    "code" => "M28606",

    "description" => "The vintage-inflected Nil bag is made from Damoflage coated canvas, Pharrell Williams’ Damier-inspired take on the camouflage pattern. The seven nuances of the same color in the checkerboard – and the signature Marque L. Vuitton Déposée – make it instantly recognizable. A removable top handle and a wide, adjustable shoulder strap provide versatile carry options. Appearance may vary slightly from photos, depending on the placement of the pattern.",

    "color" => "Indigo",

    "material" => "Damoflage",

    "dimensions" => "25 × 17.5 × 11 cm",

    "left_specs" => [
        "Indigo Blue",
        "Damoflage coated canvas",
        "Cowhide-leather trim",
        "Textile lining",
        "Aged-silver-tone hardware",
        "Zip closure",
        "Front zipped pocket",
        "Main compartment"
    ],

    "right_specs" => [
        "Inside flat pocket",
        "Strap: REMOVABLE, ADJUSTABLE",
        "Strap drop: 49.0 cm",
        "Strap drop max: 59.0 cm",
        "Handle: SIMPLE REMOVABLE"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

6 => [
    "name" => "Wallet On Chain Ivy",
    "price" => "₱142,000.00",
    "image" => "images/bag6.avif",

    "code" => "M29770",

    "description" => "This fresh and feminine take on the classic Wallet On Chain Ivy presents the Monogram Empreinte signature with a stylish pastel gradient and link-inspired embossed motif. It is crafted from cowhide with an exclusive braided chain that can be removed if desired. Sized to fit the essentials, it opens to reveal a main compartment and has two pockets, one of which is zipped to store loose change.",

    "dimensions" => "23.5 × 12 × 4.3 cm",

    "left_specs" => [
        "Monogram Empreinte Link Quartz",
        "Cowhide leather",
        "Cowhide-leather trim",
        "Microfiber lining",
        "Silver-toned hardware",
        "Magnetic closure",
        "Main compartment",
        "Inside zipped pocket",
        "Inside flat pocket"
    ],

    "right_specs" => [
        "Fits: 6.7-inch smartphone, earphones, Romy Card Holder, sunglasses, keys, lipstick",
        "Strap: REMOVABLE, ADJUSTABLE",
        "Strap drop: 22.5 cm",
        "Strap drop max: 44.0 cm",
        "Chain: REMOVABLE",
        "Chain drop: 18.5 cm"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

6 => [
    "name" => "Wallet On Chain Ivy",
    "price" => "₱142,000.00",
    "image" => "images/bag6.avif",

    "code" => "M29770",

    "description" => "This fresh and feminine take on the classic Wallet On Chain Ivy presents the Monogram Empreinte signature with a stylish pastel gradient and link-inspired embossed motif. It is crafted from cowhide with an exclusive braided chain that can be removed if desired. Sized to fit the essentials, it opens to reveal a main compartment and has two pockets, one of which is zipped to store loose change.",

    "dimensions" => "23.5 × 12 × 4.3 cm",

    "left_specs" => [
        "Monogram Empreinte Link Quartz",
        "Cowhide leather",
        "Cowhide-leather trim",
        "Microfiber lining",
        "Silver-toned hardware",
        "Magnetic closure",
        "Main compartment",
        "Inside zipped pocket",
        "Inside flat pocket"
    ],

    "right_specs" => [
        "Fits: 6.7-inch smartphone, earphones, Romy Card Holder, sunglasses, keys, lipstick",
        "Strap: REMOVABLE, ADJUSTABLE",
        "Strap drop: 22.5 cm",
        "Strap drop max: 44.0 cm",
        "Chain: REMOVABLE",
        "Chain drop: 18.5 cm"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

7 => [
    "name" => "Multipass",
    "price" => "₱167,000.00",
    "image" => "images/bag8.avif",

    "code" => "M27825",

    "status" => "New",

    "material" => "Monogram",

    "description" => "Channeling its namesake, the Multipass is a contemporary style that works for an array of occasions. Taking cues from the Express handbag, it is made from signature Monogram canvas in a slouchy profile with contrasting VVN leather trims. The gold-toned hardware lends a sleek finish, which includes a braided chain that can be removed if desired.",

    "dimensions" => "30 × 26 × 10 cm",

    "left_specs" => [
        "Monogram coated canvas",
        "Cowhide-leather trim",
        "Textile lining",
        "Gold-toned hardware",
        "Fits: 11-inch tablet, smartphone, earphones, Clémence wallet, notebook, sunglasses"
    ],

    "right_specs" => [
        "Strap: REMOVABLE, ADJUSTABLE",
        "Strap drop: 43.0 cm",
        "Strap drop max: 51.0 cm",
        "Handle: SIMPLE"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

8 => [
    "name" => "Alma BB",
    "price" => "₱161,000.00",
    "image" => "images/bag7.avif",

    "code" => "M2A378",

    "status" => "New",

    "description" => "This embroidery-inspired edition of the Alma BB showcases the House’s elevated canvas with a jacquard finish patterned with the Monogram Emblème signature. It is accented with contrasting VVN trims that complement the Rose Ruban colorway, and features a signature LV address tag and gold-toned padlock. Inside, there is an exclusive Louis Vuitton label on the cotton lining, plus a flat pocket to keep smaller items secure.",

    "dimensions" => "23.5 × 17.5 × 11.5 cm",

    "left_specs" => [
        "Monogram Emblème Rose Ruban",
        "Jacquard textile",
        "Cowhide-leather trim",
        "Cotton lining",
        "Gold-toned hardware",
        "Double zipper closure with padlock and keys",
        "Removable address tag",
        "Inside flat pocket"
    ],

    "right_specs" => [
        "4 protective metal base feet",
        "Fits: smartphone, earphones, compact wallet, sunglasses",
        "Strap: REMOVABLE, ADJUSTABLE",
        "Strap drop: 50.0 cm",
        "Strap drop max: 62.0 cm",
        "Handle: SIMPLE X2"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

9 => [
    "name" => "Neverfull MM",
    "price" => "₱209,000.00",
    "image" => "images/bag9.avif",

    "code" => "M2A381",

    "status" => "New",

    "description" => "The Neverfull MM is reinvented for the Pre-Fall 2026 collection in the House’s elevated Monogram Emblème signature. Made from jacquard canvas for a sensorial effect, this embroidery-inspired edition is trimmed with VVN side laces and a double handle, as well as a decorative address tag that can be removed if desired. Inside, it is fitted with a flat zipped pocket and reveals an exclusive Louis Vuitton label on the cotton lining.",

    "dimensions" => "47 × 28 × 14 cm",

    "left_specs" => [
        "Monogram Emblème Peuplier",
        "Jacquard textile",
        "Cowhide-leather trim",
        "Cotton lining",
        "Gold-toned hardware",
        "Hook closure",
        "4 side laces"
    ],

    "right_specs" => [
        "Inside flat zipped pocket with textile lining",
        "Removable zipped pouch",
        "Removable address tag",
        "Fits: 13-inch laptop, 6.7-inch smartphone, earphones, long Zippy Wallet, book, sunglasses",
        "Handle: SIMPLE X2"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

10 => [
    "name" => "FPM Bank Centenary 55 Spinner    ",
    "price" => "₱125,555.00",
    "image" => "images/travel1.webp",

    "code" => "FPM001",

    "status" => "New",

    "description" => "The FPM Milano x Globe-Trotter Carry-On brings together Italian engineering and British heritage, uniting FPM Milano's precision-crafted aluminium structure with Globe-Trotter's signature vulcanised fibreboard panels. Designed for seamless cabin travel, it balances strength with refined elegance.

Leather detailing and a telescopic trolley crafted with Italian leather elevate both comfort and craftsmanship, while smooth-rolling 360° wheels ensure effortless navigation through airports, stations, and city streets.

Available in Ocean Green and Black, this Carry-On is designed to travel beautifully over time. Perfect for short journeys and weekend escapes, it is a refined companion created to evolve with every adventure.",

    "dimensions" => "55 × 40 × 23 cm",

    "left_specs" => [
        "Premium aluminium shell",
        "Vulcanised fibreboard panels",
        "Italian leather trim",
        "Leather telescopic trolley handle",
        "360° spinner wheels",
        "TSA-approved lock",
        "Cabin-size carry-on"
    ],

    "right_specs" => [
        "Fits overhead compartments",
        "Leather carry handles",
        "Dual-compartment interior",
        "Adjustable compression straps",
        "Removable divider panel",
        "Silent multi-directional wheels"
    ],

    "made" => "Designed in Italy. Crafted with premium materials.",

    "material" => "Aluminium & Vulcanised Fibreboard"
],

11 => [
    "name" => "Safari Carry-On-4 Wheels",
    "price" => "₱132,555.00",
    "image" => "images/travel2.webp",

    "code" => "GT1101",

    "status" => "New",

    "description" => "Inspired by the golden age of travel, the Safari Carry-On combines timeless British craftsmanship with elegant design, featuring handcrafted fibreboard construction, natural leather accents, and gold-tone hardware. Built for effortless journeys with smooth-rolling wheels and a spacious interior, it is a refined travel companion designed to become more beautiful with every adventure.",

    "dimensions" => "55 × 42 × 24 cm",

    "left_specs" => [
        "Vulcanised fibreboard body",
        "Natural leather trim",
        "Leather handles",
        "Gold-tone hardware",
        "Four smooth-rolling wheels",
        "40-litre capacity"
    ],

    "right_specs" => [
        "Leather-capped telescopic handle",
        "Cabin-size luggage",
        "Spacious interior compartment",
        "Ideal for short trips",
        "Handcrafted in England"
    ],

    "made" => "Handcrafted in England.",

    "material" => "Vulcanised Fibreboard & Natural Leather"
],

12 => [
    "name" => "Centenary Carry-On-4 Wheels",
    "price" => "₱132,555.00",
    "image" => "images/travel3.webp",

    "code" => "GT1201",

    "status" => "New",

    "description" => "The Centenary Carry-On is a luxury cabin suitcase that combines iconic British craftsmanship with timeless design. Built from Globe-Trotter's signature vulcanised fibreboard with premium leather detailing and smooth-rolling wheels, it offers exceptional durability, elegance, and effortless travel for both business trips and weekend getaways.",

    "dimensions" => "56 × 42 × 21 cm",

    "left_specs" => [
        "Vulcanised fibreboard body",
        "Black leather corners and straps",
        "Leather handles",
        "Oxblood interior",
        "Polished gold-tone hardware",
        "Cabin-size luggage"
    ],

    "right_specs" => [
        "360° smooth-rolling wheels",
        "Leather telescopic handle",
        "Lightweight construction",
        "Ideal for 1–3 night trips",
        "Meets most airline cabin requirements"
    ],

    "made" => "Handcrafted in England.",

    "material" => "Vulcanised Fibreboard & Leather"
],

13 => [
    "name" => "PEANUTS™ Centenary Carry-On",
    "price" => "₱160,510.00",
    "image" => "images/travel4.webp",

    "code" => "GT1301",

    "status" => "Limited Edition",

    "description" => "Created in collaboration with PEANUTS™, the Centenary Carry-On Case combines Globe-Trotter's signature British craftsmanship with the timeless charm of Snoopy and Woodstock. Handcrafted from vulcanised fibreboard with premium leather detailing and smooth-rolling wheels, it is a collectible travel companion that blends heritage, functionality, and playful design.",

    "dimensions" => "56 × 42 × 21 cm",

    "left_specs" => [
        "Vulcanised fibreboard body",
        "Navy exterior finish",
        "Premium leather corners",
        "Leather handles",
        "Polished brass hardware",
        "PEANUTS™ exclusive artwork"
    ],

    "right_specs" => [
        "360° smooth-rolling wheels",
        "Extendable telescopic handle",
        "Travel-inspired interior lining",
        "Cabin-size luggage",
        "Limited Edition collaboration"
    ],

    "made" => "Handcrafted in England.",

    "material" => "Vulcanised Fibreboard & Leather"
],

14 => [
    "name" => "Safari XL Check-In-4 Wheels",
    "price" => "₱209,470.00",
    "image" => "images/travel5.wevp",

    "code" => "GT1401",

    "status" => "New",

    "description" => "Designed for extended journeys, the Safari XL Check-In combines exceptional packing capacity with Globe-Trotter's signature handcrafted construction. Built from vulcanised fibreboard with natural leather detailing, it delivers timeless elegance, outstanding durability, and effortless travel for long-haul adventures.",

    "dimensions" => "81 × 48 × 31 cm",

    "left_specs" => [
        "Vulcanised fibreboard body",
        "Natural leather corners and straps",
        "Leather-capped telescopic handle",
        "Polished gold-tone hardware",
        "96-litre capacity",
        "Four smooth-rolling wheels"
    ],

    "right_specs" => [
        "Zip-secured lid lining",
        "Adjustable interior webbing straps",
        "Ideal for extended journeys",
        "Meets most airline check-in requirements",
        "Spacious main compartment"
    ],

    "made" => "Handcrafted in England.",

    "material" => "Vulcanised Fibreboard & Natural Leather"
],

15 => [
    "name" => "Centenary Large Check-In-4 Wheels",
    "price" => "₱174,500.00",
    "image" => "images/travel6.webp",

    "code" => "GT1501",

    "status" => "New",

    "description" => "The Centenary Large Check-In combines over a century of British craftsmanship with exceptional packing capacity for extended journeys. Handcrafted from Globe-Trotter's signature vulcanised fibreboard with premium leather detailing, it offers timeless elegance, lightweight durability, and effortless travel for trips lasting up to two weeks.",

    "dimensions" => "75 × 50 × 26 cm",

    "left_specs" => [
        "Vulcanised fibreboard body",
        "Black leather corners and straps",
        "Leather-wrapped trolley handle",
        "Polished brass hardware",
        "83-litre capacity",
        "Four smooth-rolling wheels"
    ],

    "right_specs" => [
        "Spacious interior compartment",
        "Adjustable interior webbing straps",
        "Ideal for 10–14 night trips",
        "Lightweight yet durable construction",
        "Ergonomic trolley handle"
    ],

    "made" => "Handcrafted in England.",

    "material" => "Vulcanised Fibreboard & Leather"
],

16 => [
    "name" => "Trio Messenger",
    "price" => "₱178,000.00",
    "image" => "images/men1.avif",

    "code" => "M28628",

    "description" => "Inspired by 2000s Japanese streetwear, the Trio Messenger is crafted from Monogram Eclipse canvas with khaki-green leather trim for a sporty yet refined look. Featuring a main pouch, removable zipped pocket, detachable coin purse, and an adjustable signature strap, it combines everyday functionality with contemporary style.",

    "dimensions" => "25 × 18.5 × 7 cm",

    "left_specs" => [
        "Khaki Green",
        "Monogram Eclipse coated canvas",
        "Cowhide-leather trim",
        "Textile lining",
        "Ruthenium-tone brass hardware",
        "Front flat pocket on main pouch"
    ],

    "right_specs" => [
        "Inside flat pocket",
        "Removable small coin purse on strap",
        "Strap: REMOVABLE, ADJUSTABLE",
        "Strap drop: 40.0 cm",
        "Strap drop max: 64.0 cm"
    ],

    "made" => "This reference is either Made in France, Spain, Italy or in the U.S.",

    "material" => "Monogram Eclipse"
],

17 => [
    "name" => "Avenue Slingbag PM",
    "price" => "₱183,000.00",
    "image" => "images/men2.avif",

    "code" => "M2A354",

    "description" => "Compact and functional, the Avenue Slingbag is fashioned from Taurillon Monogram leather, a full-grain cowhide embossed with the iconic Monogram pattern. A stylish alternative to the classic backpack, this piece adjusts for left- or right-sided cross-body wear. The layout features a main zipped compartment, a front zipped pocket, and a discreet, triangular top pocket.",

    "dimensions" => "16 × 33 × 5.7 cm",

    "left_specs" => [
        "Black",
        "Taurillon Monogram cowhide leather",
        "Taurillon cowhide-leather trim",
        "Textile lining",
        "Silver-tone hardware for Forest Green / Matte black-color hardware for Black"
    ],

    "right_specs" => [
        "Main compartment with an inside pocket",
        "Front zipped pocket",
        "Small zipped pocket on top of the bag",
        "Strap: NOT REMOVABLE, ADJUSTABLE",
        "Strap drop: 27.5 cm",
        "Strap drop max: 48.7 cm"
    ],

    "made" => "Made in France, Spain or Italy or made in the U.S. of imported materials."
],

18 => [
    "name" => "Keepall Bandoulière 35",
    "price" => "₱168,000.00",
    "image" => "images/men4.avif",

    "code" => "M28639",

    "description" => "The versatile Keepall Bandoulière 35 in Monogram Eclipse canvas presents a sophisticated contrast with its dark khaki-green leather bands and top handles. A lighter green name tag adds a subtle variation on the utilitarian design, while the roomy textile-lined interior easily accommodates a day's essentials.",

    "dimensions" => "34 × 21 × 16 cm",

    "left_specs" => [
        "Khaki Green",
        "Monogram Eclipse coated canvas",
        "Cowhide-leather trim",
        "Textile lining",
        "Ruthenium-tone brass hardware",
        "Zip closure",
        "Main compartment"
    ],

    "right_specs" => [
        "Removable leather nametag",
        "Inside flat pocket",
        "Strap: REMOVABLE, ADJUSTABLE",
        "Strap drop: 43.0 cm",
        "Strap drop max: 65.0 cm",
        "Handle: SIMPLE X2"
    ],

    "made" => "This reference is either Made in France, Spain, Italy or in the U.S."
],

19 => [
    "name" => "Courrier Messenger",
    "price" => "₱220,000.00",
    "image" => "images/men5.avif",

    "code" => "M28781",

    "description" => "Inspired by the classic mail carrier bag, the Courrier Messenger is crafted from Monogram Shadow calfskin leather with a refined, contemporary design. Featuring multiple exterior pockets, a spacious interior, and an innovative adjustable buckle, it combines everyday practicality with premium craftsmanship.",

    "dimensions" => "37 × 27 × 12 cm",

    "left_specs" => [
        "Black",
        "Monogram Shadow calfskin leather",
        "Cowhide-leather trim",
        "Textile lining",
        "Black-color hardware",
        "Front zipped pocket on flap",
        "2 front flat pockets under flap"
    ],

    "right_specs" => [
        "Large main compartment fits an 11-inch tablet computer",
        "Inside flat pocket",
        "Front D-ring",
        "Strap: NOT REMOVABLE, ADJUSTABLE",
        "Strap drop max: 70.0 cm"
    ],

    "made" => "This reference is either Made in France, Spain, Italy or in the U.S."
],

20 => [
    "name" => "District PM",
    "price" => "₱129,000.00",
    "image" => "images/men6.avif",

    "code" => "M46255",

    "description" => "Made from masculine Monogram Eclipse canvas, the District PM is a messenger-style bag with a contemporary design. An outside back zipped pocket gives quick access to essentials while the adjustable shoulder strap ensures comfortable carry, complemented by black metallic LV initials for a refined finish.",

    "material" => "Monogram Eclipse",

    "dimensions" => "26 × 20 × 7 cm",

    "left_specs" => [
        "Monogram Eclipse coated canvas",
        "Cowhide-leather trim",
        "Textile lining",
        "Silver-color hardware",
        "Flap with magnetic closure",
        "Zipped back pocket"
    ],

    "right_specs" => [
        "2 inside flat pockets",
        "Inside front pocket",
        "Strap: NOT REMOVABLE, ADJUSTABLE",
        "Strap drop: 31.0 cm",
        "Strap drop max: 62.0 cm"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

21 => [
    "name" => "Speedy Bandoulière 20",
    "price" => "₱143,000.00",
    "image" => "images/women1.avif",

    "code" => "M46234",

    "description" => "Like a diminutive version of the House's historic Speedy travel bag, the Speedy Bandoulière 20 is crafted from Monogram canvas with natural cowhide trim. Featuring rolled leather top handles, a detachable and adjustable woven signature strap, and a compact interior, it combines timeless elegance with everyday practicality.",

    "dimensions" => "20.5 × 13.5 × 12 cm",

    "left_specs" => [
        "Black",
        "Monogram coated canvas",
        "Natural-cowhide trim",
        "Textile lining",
        "Gold-color hardware",
        "Padlock",
        "Inside flat pocket"
    ],

    "right_specs" => [
        "Fits: 6.7-inch smartphone, Lou wallet, keys, lipstick, tissues, sunglasses",
        "Weight: 0.6 kg",
        "Strap: REMOVABLE, ADJUSTABLE",
        "Strap drop: 39.0 cm",
        "Strap drop max: 58.0 cm",
        "Handle: SIMPLE X2"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

22 => [
    "name" => "Nano Madeleine",
    "price" => "₱175,000.00",
    "image" => "images/women2.avif",

    "code" => "M2A374",

    "status" => "Pre-order Now",

    "description" => "Elevated with a chic pastel gradient, the Nano Madeleine showcases the House's Monogram Empreinte signature with a link-inspired motif set on Quartz leather. Finished with an iconic S-lock closure and a removable braided chain, this compact handbag offers elegant versatility for both everyday wear and special occasions.",

    "dimensions" => "21 × 12.5 × 6 cm",

    "left_specs" => [
        "Monogram Empreinte Link Quartz",
        "Cowhide leather",
        "Cowhide-leather trim",
        "Microfiber lining",
        "Silver-toned hardware",
        "Flat pocket with 3 card slots"
    ],

    "right_specs" => [
        "Gusseted compartment",
        "S-lock closure",
        "Fits: smartphone, compact wallet, lipstick",
        "Chain: ADJUSTABLE, REMOVABLE",
        "Chain drop: 55.0 cm",
        "Handle: SIMPLE"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

23 => [
    "name" => "Squire East-West",
    "price" => "₱144,000.00",
    "image" => "images/women4.avif",

    "code" => "M2A457",

    "status" => "New",

    "description" => "This edition of the Squire East-West is part of the Monogram Dune collection. Crafted from Monogram Dune coated canvas with signature VVN leather trims, it features gold-toned hardware, a secure double zipper closure, and adjustable handles for versatile everyday carry.",

    "dimensions" => "29 × 14 × 8 cm",

    "left_specs" => [
        "Monogram Dune coated canvas",
        "Cowhide-leather trim",
        "Textile lining",
        "Gold-toned hardware",
        "Double zipper closure",
        "Padlock",
        "Inside flat pocket"
    ],

    "right_specs" => [
        "Fits: 6.7-inch smartphone, Sarah Long Wallet, notebook, sunglasses, keys",
        "Strap: NOT REMOVABLE, ADJUSTABLE",
        "Strap drop: 28.0 cm",
        "Strap drop max: 31.0 cm",
        "Handle: SIMPLE X2"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

24 => [
    "name" => "Vanity Chain Pouch",
    "price" => "₱190,000.00",
    "image" => "images/women5.avif",

    "code" => "M29782",

    "status" => "Pre-order Now",

    "description" => "Modeled on archival Louis Vuitton cases, the Vanity Chain Pouch embodies the House's travel DNA with the playful elegance of the LV Crafty collection. Crafted from Monogram Dune coated canvas with premium leather trims, it features a removable keybell, adjustable strap, and detachable chain for versatile everyday styling.",

    "dimensions" => "19 × 11.5 × 6.5 cm",

    "left_specs" => [
        "Monogram Dune coated canvas",
        "Cowhide-leather trim",
        "Microfiber lining",
        "Gold-toned hardware",
        "Zipper closure",
        "Removable keybell with studs"
    ],

    "right_specs" => [
        "Fits: 6.7-inch smartphone, earphones, Rosalie Coin Purse, sunglasses, keys, lipstick",
        "Strap: REMOVABLE, ADJUSTABLE",
        "Strap drop: 49.0 cm",
        "Strap drop max: 58.0 cm",
        "Chain: REMOVABLE",
        "Chain drop: 26.0 cm",
        "Handle: SIMPLE"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

25 => [
    "name" => "Trunkie East West",
    "price" => "₱191,000.00",
    "image" => "images/women6.avif",

    "code" => "M27266",

    "status" => "New",

    "description" => "This East West edition of the Trunkie handbag takes inspiration from the original trunk design while offering a modern baguette-style silhouette. Crafted from signature Monogram canvas with leather latches, gold-toned corners, and a signature S-lock, it blends Louis Vuitton's travel heritage with contemporary elegance.",

    "dimensions" => "25 × 15 × 6 cm",

    "left_specs" => [
        "Monogram coated canvas",
        "Cowhide-leather trim",
        "Microfiber lining",
        "Gold-toned hardware",
        "Flap closure with magnetic S-lock"
    ],

    "right_specs" => [
        "Inside zipped pocket",
        "Chain: SLIDING, NOT REMOVABLE",
        "Chain drop: 30.0 cm",
        "Chain drop max: 48.0 cm"
    ],

    "made" => "Made in France, Spain or Italy, or Made in the U.S. of imported materials."
],

];

if (!isset($products[$id])) {
    $id = 1;
}

$product = $products[$id];

if(isset($_POST['wishlist'])){

    if(!isset($_SESSION['wishlist'])){
        $_SESSION['wishlist'] = [];
    }

    if(!in_array($id, $_SESSION['wishlist'])){
        $_SESSION['wishlist'][] = $id;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $product['name']; ?> | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=2">

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<!-- HEADER -->

<header>

    <div class="logo">
        <a href="index.php">
            <img src="images/logo.png" alt="emPIEsema">
        </a>
    </div>

    <nav>

        <ul>

            <li><a href="shop.php">Shop</a></li>
            <li><a href="#">Collections</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>

        </ul>

    </nav>

    <div class="nav-icons">

        <i class="fa-solid fa-user"></i>

        <i class="fa-solid fa-heart"></i>

        <i class="fa-solid fa-cart-shopping"></i>

        <i class="fa-solid fa-magnifying-glass"></i>

    </div>

</header>

<!-- PRODUCT -->

<section class="product-page">

    <div class="product-image">

        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">

    </div>

    <div class="product-details">

    <div class="product-header">

        <div>

                <span class="product-code">M29537</span>

                <h1><?php echo $product['name']; ?></h1>

                <h2><?php echo $product['price']; ?></h2>

            </div>

            <form method="POST">

                <button type="submit" name="wishlist" class="wishlist-btn">

                    <i class="fa-regular fa-heart"></i>

                </button>

            </form>

        </div>

    <p class="description">
        <?php echo $product['description']; ?>
    </p>

        <div class="dimensions">
            <strong>24 × 13 × 8 cm</strong><br>
            (Length × Height × Width)
        </div>

        <div class="specifications">

            <ul>

                <li>Monogram coated canvas</li>
                <li>Cowhide-leather trim</li>
                <li>Microfiber lining</li>
                <li>Gold-toned hardware</li>
                <li>Drawstring closure</li>
                <li>3 compartments</li>
                <li>Zipped pocket</li>

            </ul>

            <ul>

                <li>Fits smartphone</li>
                <li>Wallet</li>
                <li>Removable strap</li>
                <li>Adjustable strap</li>
                <li>Strap drop: 29 cm</li>
                <li>Maximum strap: 50 cm</li>

            </ul>

        </div>

        <p class="made">
            Made in France, Spain or Italy, or Made in the U.S. of imported materials.
        </p>

        <a href="shop.php" class="btn">Back to Shop</a>

    </div>

</section>

</body>
</html>