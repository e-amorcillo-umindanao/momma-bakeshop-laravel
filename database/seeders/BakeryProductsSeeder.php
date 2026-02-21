<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;

class BakeryProductsSeeder extends Seeder
{
    public function run()
    {
        $rawData = <<<EOD
CLASSIC FILIPINO BREADS (Tinapay)
#	Item	Est. Price (₱)
1	Pandesal (classic)	3–5
2	Pandesal de suelo	3–5
3	Cheese pandesal	8–15
4	Ube pandesal	8–15
5	Malunggay pandesal	5–10
6	Whole wheat pandesal	5–10
7	Pandesal with asado filling	10–20
8	Pandesal with chicken floss	10–20
9	Pandesal with corned beef	10–20
10	Pandesal with sardines	10–18
11	Pandesal especial	8–15
12	Pandesal with butter filling	8–15
13	Pandesal with yema	10–18
14	Monay	5–10
15	Monay with cheese	8–15
16	Pan de coco	5–10
17	Pan de coco especial	8–15
18	Spanish bread	5–10
19	Mini Spanish bread	3–5
20	Putok (cracked-top bread)	5–10
21	Kababayan	5–10
22	Bonete	5–10
23	Pan de leche	5–12
24	Kalihim (Pan de regla)	5–10
25	Pinagong (turtle bread)	5–10
26	Tasty bread (loaf)	55–85
27	Pan americano (Pullman loaf)	65–100
28	Elorde bread	5–8
29	Señorita bread	5–10
30	Pan de monja	5–10
31	Pan de campus	5–10
32	Pan de bono	5–8
33	Pan de agua	3–5
34	Pan de pula	3–5
35	Pan de suelo	3–5
36	Pan de pugon	5–10
37	Pan de Manila (branded)	6–10
38	Panecillo	5–8
39	Bollo	5–10
40	Pan dulce	5–10
41	Torta	5–10
42	Pan de ube	8–15
43	Star bread	5–10
44	Egg bread	5–10
45	Sugar-topped bread	5–8
ENSAYMADA VARIETIES
#	Item	Est. Price (₱)
46	Plain ensaymada	15–30
47	Cheese ensaymada	25–60
48	Ube ensaymada	25–55
49	Butter ensaymada	20–45
50	Ham and cheese ensaymada	35–75
51	Macapuno ensaymada	30–65
52	Yema ensaymada	25–55
53	Quezo de bola ensaymada	65–150
54	Sugar ensaymada	15–30
55	Pandan ensaymada	25–50
56	Chocolate ensaymada	25–55
57	Mini ensaymada	10–20
58	Toasted ensaymada	15–30
MAMON & RELATED
#	Item	Est. Price (₱)
59	Mamon (classic)	15–35
60	Mamon tostado	10–25
61	Ube mamon	20–40
62	Cheese mamon	20–40
63	Chocolate mamon	20–40
64	Pandan mamon	20–40
65	Mamon with buttercream	25–45
66	Mini mamon	10–18
67	Mocha mamon	20–40
68	Toasted mamon	10–20
PIANONO / CAKE ROLLS
#	Item	Est. Price (₱)
69	Pianono (classic)	15
70	Ube pianono	18
71	Cheese pianono	18
72	Chocolate pianono	18
73	Yema pianono	18
74	Mocha pianono	18
75	Pandan pianono	18
76	Mango pianono	20
77	Strawberry pianono	20
TAISAN (CHIFFON LOAF)
#	Item	Est. Price (₱)
78	Taisan (plain)	60–120
79	Taisan cheese	75–140
80	Taisan ube	75–140
81	Taisan pandan	75–130
82	Taisan mocha	75–130
BREAD LOAVES
#	Item	Est. Price (₱)
83	White bread loaf	55–90
84	Wheat bread loaf	65–100
85	Raisin bread loaf	75–120
86	Cheese loaf	80–130
87	Ube loaf	80–130
88	Pandan loaf	75–120
89	Chocolate loaf	75–120
90	Banana loaf	75–130
91	Marble loaf	75–120
92	Cinnamon raisin loaf	85–130
93	Malunggay loaf	70–110
94	Oatmeal loaf	75–120
95	Multigrain loaf	85–140
96	Brioche loaf	100–180
97	Milk bread loaf	75–120
98	French bread loaf	50–90
99	Sourdough loaf	120–220
100	Garlic loaf	75–120
PIES
#	Item	Est. Price (₱)
101	Egg pie (whole)	120–250
102	Buko pie (whole)	150–300
103	Ube pie (whole)	150–280
104	Custard pie (whole)	130–250
105	Buko pandan pie (whole)	160–300
106	Cheese pie (whole)	150–280
107	Apple pie (whole)	200–350
108	Mango pie (whole)	200–350
109	Sweet potato pie (whole)	140–260
110	Pineapple pie (whole)	180–300
111	Fruit cocktail pie (whole)	180–300
112	Chocolate pie (whole)	180–320
113	Macapuno pie (whole)	170–300
114	Ube macapuno pie (whole)	180–320
115	Leche flan pie (whole)	180–300
116	Yema pie (whole)	160–280
117	Banana cream pie (whole)	180–320
118	Coconut cream pie (whole)	180–300
119	Calamansi pie (whole)	180–300
120	Graham pie (whole)	180–300
121	Meringue-topped pie (whole)	200–350
EMPANADA & FILLED SAVORY PASTRIES
#	Item	Est. Price (₱)
122	Empanada (chicken)	15–35
123	Empanada (beef)	18–40
124	Empanada (sardines)	12–30
125	Empanada (pork)	15–35
126	Empanada kaliskis (flaky)	20–45
127	Meat pie (individual)	25–50
128	Chicken pie (individual)	25–50
129	Tuna bread roll	15–30
130	Ham bread	15–30
131	Hotdog bread / Hotdog roll	15–30
132	Longganisa bread	18–35
133	Corned beef bread	15–30
134	Bacon bread	20–40
135	Sisig bread	20–40
136	Adobo bread	20–38
137	Pizza bread	15–35
138	Cheese-filled bread	12–25
139	Sausage roll	18–35
140	Bacon and cheese bread	25–45
141	Tuna melt bread	20–40
142	Chicken floss bread	15–30
143	Meat floss bread	15–30
144	Ham and cheese roll	20–40
145	Calzone bread	25–50
146	Cheese pimiento bread	18–35
SIOPAO
#	Item	Est. Price (₱)
147	Siopao asado	25–55
148	Siopao bola-bola	25–55
149	Siopao chicken	25–50
150	Siopao special (with egg)	35–65
151	Fried siopao	20–40
152	Baked siopao	25–50
153	Mini siopao	10–20
154	Siopao with salted egg	35–60
HOPIA
#	Item	Est. Price (₱)
155	Hopia monggo (mung bean)	12–25
156	Hopia ube	12–25
157	Hopia baboy (pork)	15–30
158	Hopia pandan	12–25
159	Hopia macapuno	15–28
160	Hopia langka (jackfruit)	12–25
161	Hopia hapon	12–25
162	Hopia special	15–30
163	Hopia monggo w/ salted egg	18–35
164	Hopia custard	15–28
165	Hopia ube macapuno	15–30
CAKES
#	Item	Est. Price (₱)
166	Ube cake	350–650
167	Chocolate cake	350–700
168	Mocha cake	350–650
169	Butter cake	250–500
170	Chiffon cake (plain)	200–400
171	Ube chiffon cake	250–450
172	Pandan chiffon cake	220–420
173	Orange chiffon cake	220–400
174	Lemon chiffon cake	220–400
175	Marble chiffon cake	230–420
176	Chocolate chiffon cake	250–450
177	Sponge cake	180–350
178	Yema cake	350–600
179	Leche flan cake	400–700
180	Sans rival (whole)	450–900
181	Brazo de mercedes (roll)	250–500
182	Silvanas (box of 10–12)	250–500
183	Mango cake	400–750
184	Fruit cake	350–650
185	Carrot cake	350–650
186	Red velvet cake	400–750
187	Caramel cake	350–600
188	Coffee cake	300–550
189	Banana cake	250–500
190	Cassava cake (bilao/tray)	200–400
191	Bibingka cake	200–400
192	Tres leches cake	400–700
193	Black forest cake	400–750
194	Angel food cake	200–400
195	Pound cake	200–400
196	Quezo de bola cake	500–900
197	Dulce de leche cake	400–700
198	Calamansi cake	300–550
199	Coconut cake	350–600
200	Inipit (box of 12)	180–350
201	Napoleones (box of 6–10)	200–400
202	Crema de fruta	400–750
203	Fruit salad cake	400–700
204	Graham cake (icebox)	300–550
205	Mango float cake	350–650
206	Ube halaya cake	400–700
207	Buko salad cake	350–600
208	Cheesecake (classic)	400–800
209	Ube cheesecake	450–850
210	Japanese cheesecake	350–650
211	Basque cheesecake	450–850
212	Crumb cake	250–450
213	Streusel cake	280–480
214	Pineapple upside-down cake	300–550
215	Honey cake	300–550
ROLL CAKES / SWISS ROLLS (Whole roll)
#	Item	Est. Price (₱)
216	Swiss roll (vanilla)	150–300
217	Ube roll cake	180–350
218	Chocolate roll cake	180–350
219	Mocha roll cake	180–350
220	Mango roll cake	200–380
221	Yema roll cake	180–350
222	Strawberry roll cake	200–380
223	Pandan roll cake	180–350
CUPCAKES
#	Item	Est. Price (₱)
224	Cheese cupcake	20–50
225	Ube cupcake	25–55
226	Chocolate cupcake	25–55
227	Vanilla cupcake	20–50
228	Red velvet cupcake	30–65
229	Mocha cupcake	25–55
230	Pandan cupcake	25–50
231	Butter cupcake	20–45
232	Banana cupcake	25–50
233	Lemon cupcake	25–55
234	Carrot cupcake	30–60
235	Yema cupcake	25–55
236	Leche flan cupcake	30–65
237	Buko pandan cupcake	28–55
238	Double chocolate cupcake	30–65
MUFFINS
#	Item	Est. Price (₱)
239	Blueberry muffin	30–65
240	Chocolate muffin	25–55
241	Banana muffin	25–50
242	Cheese muffin	25–55
243	Bran muffin	25–50
244	Corn muffin	25–50
245	Lemon poppy seed muffin	30–60
246	Carrot muffin	30–55
247	Ube muffin	30–55
248	Pandan muffin	28–55
249	Apple cinnamon muffin	30–60
250	Double chocolate muffin	30–65
251	Cranberry muffin	35–65
252	Oatmeal muffin	28–55
DONUTS
#	Item	Est. Price (₱)
253	Sugar donut	10–25
254	Glazed donut	15–35
255	Chocolate donut	18–40
256	Bavarian cream donut	20–45
257	Ube donut	20–40
258	Cheese donut	18–40
259	Cinnamon sugar donut	15–35
260	Powdered sugar donut	12–30
261	Twisted donut	10–25
262	Donut holes (munchkins, 6 pcs)	30–60
263	Long john donut	20–40
264	Custard-filled donut	20–45
265	Strawberry jam donut	18–40
266	Chocolate-filled donut	20–45
267	Old-fashioned donut	15–35
268	Crumb donut	18–38
FRIED BREADS & FILIPINO FRITTERS
#	Item	Est. Price (₱)
269	Pilipit (twisted fried dough)	3–8
270	Bicho-bicho (bitso-bitso)	5–10
271	Shakoy	5–10
272	Buchi (sesame balls)	8–15
273	Binangkal	5–10
274	Cascaron	5–10
275	Churros (1 pc)	15–35
276	Buñuelos	8–15
277	Maruya (banana fritters)	10–20
278	Turon (banana spring roll)	10–20
279	Karioka (coconut rice balls, stick)	10–20
280	Kumukunsi	5–10
281	Lumpiang saging	10–20
282	Carioca on a stick	10–20
COOKIES & BISCUITS
#	Item	Est. Price (₱)
283	Broas (lady fingers, pack)	40–80
284	Lengua de gato (box/pack)	80–180
285	Barquillos (pack)	50–120
286	Uraro cookies (pack)	60–120
287	Butter cookies (per pc)	10–25
288	Chocolate chip cookies	15–35
289	Oatmeal cookies	15–30
290	Oatmeal raisin cookies	15–35
291	Peanut butter cookies	15–30
292	Chocolate crinkles	10–25
293	Red velvet crinkles	12–28
294	Ube crinkles	12–28
295	Pandan crinkles	12–25
296	Sugar cookies	10–25
297	Shortbread cookies	15–30
298	Thumbprint cookies	12–28
299	Cornflake cookies	10–25
300	Meringue cookies / kisses	8–20
301	Biscotti (per pc)	20–45
302	Gingerbread cookies	15–35
303	Snickerdoodle	15–30
304	Alfajor	20–40
305	Sandwich cookies	12–28
306	Coconut macaroons	10–25
307	Puto seko (pack)	30–80
308	Marie biscuits (pack)	25–50
309	Egg cracker biscuits (pack)	20–45
310	Cream crackers (pack)	20–50
311	Animal crackers (pack)	20–40
312	Arrowroot cookies (pack)	25–50
313	Wafer sticks (pack)	25–55
314	Pinwheel cookies	15–30
315	Iced cookies	15–35
316	Almond cookies	18–35
317	Cashew cookies	18–35
318	Cheese cookies	12–28
POLVORON
#	Item	Est. Price (₱)
319	Polvoron (classic, per pc)	8–15
320	Polvoron pinipig	8–18
321	Polvoron cookies and cream	10–20
322	Polvoron ube	10–18
323	Polvoron chocolate	10–18
324	Polvoron peanut	8–15
325	Polvoron cashew	12–22
326	Polvoron strawberry	10–18
327	Polvoron matcha	12–22
328	Polvoron malunggay	10–18
BROWNIES & BARS
#	Item	Est. Price (₱)
329	Classic brownie	25–55
330	Fudge brownie	30–65
331	Ube brownie	30–60
332	Cheesecake brownie	35–70
333	Walnut brownie	35–75
334	Blondie	25–55
335	Lemon bar	25–55
336	Graham bar	20–45
337	Cereal bar	20–45
338	Butterscotch bar	20–45
339	Date bar	25–50
340	Ube bar	25–50
341	Chocolate bar (baked)	25–55
342	Peanut butter bar	25–50
PASTRIES, DANISH & CROISSANTS
#	Item	Est. Price (₱)
343	Cream puff	20–45
344	Eclair (chocolate)	25–55
345	Cheese danish	35–75
346	Apple danish	35–75
347	Fruit danish	35–80
348	Croissant (plain)	35–75
349	Cheese croissant	45–90
350	Chocolate croissant	45–95
351	Ham and cheese croissant	55–110
352	Almond croissant	55–120
353	Puff pastry (plain)	25–50
354	Palmier (butterfly pastry)	20–45
355	Cream horn	25–50
356	Cinnamon roll	35–75
357	Sticky bun	35–75
358	Apple turnover	30–65
359	Pineapple turnover	30–60
360	Ube turnover	30–60
361	Cheese turnover	30–60
362	Fruit strudel	35–70
363	Profiteroles (3 pcs)	55–100
364	Mille-feuille	55–110
365	Choux pastry shell	15–30
366	Cannoli	45–90
TARTS & TARTLETS
#	Item	Est. Price (₱)
367	Egg tart	20–45
368	Fruit tart	40–85
369	Ube tart	30–60
370	Custard tart	25–50
371	Cheese tart	35–75
372	Lemon tart	35–70
373	Mango tartlet	35–75
374	Buko tartlet	30–60
375	Chocolate tartlet	35–70
KAKANIN (Rice Cakes & Native Delicacies)
#	Item	Est. Price (₱)
376	Puto (white, per pc)	5–12
377	Puto cheese	8–18
378	Puto ube	8–18
379	Puto pandan	8–15
380	Puto pao	10–20
381	Puto flan	12–25
382	Kutsinta (per pc)	5–10
383	Bibingka (per pc)	15–40
384	Bibingka galapong	20–45
385	Bibingka especial	30–65
386	Bibingka w/ salted egg & cheese	35–70
387	Cassava bibingka (tray/slice)	15–30
388	Sapin-sapin (per slice)	15–30
389	Palitaw (per pc)	5–12
390	Suman sa lihiya (per pc)	8–15
391	Suman sa ibos (per pc)	10–18
392	Suman latik (per pc)	10–20
393	Suman moron (chocolate suman)	12–22
394	Suman sa gata (per pc)	10–18
395	Biko (per serving/slice)	15–30
396	Biko with latik (per serving)	18–35
397	Espasol (per pc)	8–15
398	Kalamay (small container)	30–80
399	Pichi-pichi (per pc)	5–12
400	Maja blanca (per slice)	12–25
401	Baye-baye (per pc)	8–15
402	Tikoy / nian gao (whole)	150–400
403	Nilupak (per serving)	15–30
404	Tibok-tibok (per serving)	20–40
405	Tupig (per pc)	8–15
406	Budbud (per pc)	8–15
407	Ginataang bilo-bilo (cup)	25–50
408	Palitaw w/ sesame & coconut	8–15
CUSTARDS, FLANS & SWEETS
#	Item	Est. Price (₱)
409	Leche flan (per slice)	30–60
410	Leche flan (whole, llanera)	180–400
411	Yema balls (per pc)	5–12
412	Yema spread (jar)	80–150
413	Pastillas de leche (per pc)	5–10
414	Pastillas de ube (per pc)	5–12
415	Meringue (baked, per pc)	8–15
416	Dulce de leche (jar)	100–200
417	Ube halaya (jar/tub)	100–250
418	Macapuno preserves (jar)	100–200
419	Coconut jam / matamis na bao (jar)	80–150
420	Bread pudding (per serving)	30–60
421	Ube bread pudding	35–65
422	Chocolate bread pudding	35–65
REGIONAL BAKESHOP SPECIALTIES
#	Item	Est. Price (₱)
423	Ilocos empanada	30–60
424	Vigan empanada	35–65
425	Pastel de Camiguin	25–50
426	Piaya (Bacolod, muscovado)	10–20
427	Piaya ube	12–22
428	Piaya langka	12–22
429	Piaya pandan	12–22
430	Napoleones (Bacolod, per pc)	25–50
431	Butterscotch (Cebu, per pc)	10–20
432	Rosquillos (Liloan, Cebu, pack)	60–150
433	Torta de Cebu	15–30
434	Masareal (Pampanga, pack)	50–120
435	Broas de Guagua (pack)	50–100
436	Galletas de Pampanga (pack)	60–120
437	Biscocho de Iloilo (pack)	50–100
438	Pinasugbo (Batangas, pack)	80–180
439	Panutsa (per pc)	5–12
440	Ilocos garlic bread	8–15
441	Pan de Bisaya	3–8
442	Masi (Taal, Batangas, per pc)	10–20
443	Piaya muscovado	10–20
444	Tsokolate tablea cookies	15–30
445	Otap (Cebu, pack)	50–120
BISCOCHO & TOASTED BREADS
#	Item	Est. Price (₱)
446	Biscocho (classic, pack)	40–90
447	Biscocho with butter (pack)	50–100
448	Biscocho with sugar (pack)	40–90
449	Biscocho with garlic (pack)	50–100
450	Toasted bread / rusk (pack)	30–70
451	Melba toast (pack)	40–80
452	Bread chips (assorted, pack)	40–80
453	Crostini (pack)	50–100
454	Mamon tostado (pack)	40–90
SANDWICH BREADS & ROLLS
#	Item	Est. Price (₱)
455	Sandwich bread (white, loaf)	55–90
456	Sandwich bread (wheat, loaf)	65–100
457	Hot dog bun (per pc)	8–15
458	Hamburger bun (per pc)	10–20
459	Kaiser roll	12–25
460	Dinner roll	8–15
461	Panini bread	15–30
462	Sub roll / French roll	15–30
463	Slider bun	8–15
464	Soft roll	8–15
SPECIALTY & FLAVORED BREADS
#	Item	Est. Price (₱)
465	Cinnamon bread	10–20
466	Raisin bread (individual)	10–20
467	Cheese bread (round)	10–20
468	Coconut bread	8–15
469	Pandan bread	8–15
470	Ube cheese bread	12–25
471	Garlic bread (per pc)	10–20
472	Herb bread	12–22
473	Kamote (sweet potato) bread	8–15
474	Squash bread	8–15
475	Carrot bread	10–18
476	Pumpkin bread	10–20
477	Matcha bread	12–25
478	Coffee bread	10–20
479	Mocha bread	10–20
480	Caramel bread	10–20
481	Dulce de leche bread	12–22
482	Monggo-filled bread	8–15
483	Yema-filled bread	10–20
484	Custard-filled bread	10–20
485	Taro bread	10–18
486	Corn bread (individual)	10–20
487	Sweet corn bread	10–20
488	Pull-apart bread (plain)	55–100
489	Cheese pull-apart bread	75–130
490	Garlic pull-apart bread	70–120
491	Ube pull-apart bread	75–130
492	Cheese bread sticks	10–20
493	Plain bread sticks	8–15
494	Garlic bread sticks	10–20
495	Sugar twist bread	8–15
496	Ube twist bread	10–18
497	Pandan twist bread	10–18
MISCELLANEOUS BAKESHOP ITEMS
#	Item	Est. Price (₱)
498	Graham balls (per pc)	10–20
499	Chocolate truffles (per pc)	15–35
500	Pandesal bites / mini pandesal (bag)	25–50
EOD;

        $lines = explode("\n", $rawData);

        $currentCategory = null;

        foreach ($lines as $line) {
            $line = trim($line);

            if (empty($line) || str_starts_with($line, '#')) {
                continue;
            }

            // If line doesn't start with a number, it's a category
            if (!preg_match('/^[0-9]/', $line)) {
                $categoryName = $line;

                // Remove parentheticals for description
                $descMatch = [];
                $desc = '';
                if (preg_match('/\((.*?)\)/', $categoryName, $descMatch)) {
                    $desc = $descMatch[1];
                    $categoryName = trim(preg_replace('/\s*\(.*?\)/', '', $categoryName));
                }

                $currentCategory = Category::firstOrCreate([
                    'CategoryName' => $categoryName
                ], [
                    'Description' => empty($desc) ? $categoryName : $desc,
                    'DateAdded' => Carbon::now(),
                    'DateModified' => Carbon::now()
                ]);
                continue;
            }

            // It's a product line
            // Example format: 1	Pandesal (classic)	3–5
            // Splitting by tabs
            $parts = explode("\t", $line);
            if (count($parts) >= 3) {
                $name = trim($parts[1]);
                $priceStr = trim($parts[2]);

                // Parse price (extract the first number if it's a range like 3-5 or 10-25 / pack)
                $price = 0.00;
                if (preg_match('/([0-9\.]+)/', $priceStr, $matches)) {
                    $price = (float) $matches[1];
                }

                Product::create([
                    'ProductName' => $name,
                    'ProductDescription' => 'Freshly baked ' . strtolower($name),
                    'CategoryID' => $currentCategory ? $currentCategory->ID : 1,
                    'Price' => $price,
                    // Give them a starting inventory between 10 to 100 so the POS has stock
                    'Quantity' => rand(15, 80),
                    'LowStockThreshold' => 10,
                    'DateAdded' => Carbon::now(),
                    'DateModified' => Carbon::now()
                ]);
            }
        }
    }
}
