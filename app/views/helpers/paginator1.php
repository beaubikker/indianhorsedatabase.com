
 	<?php
 	/**
 	* Pagination Helper class file.
 	*
 	* Generates pagination links
 	*
 	* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 	* Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 	*
 	* Licensed under The MIT License
 	* Redistributions of files must retain the above copyright notice.
 	*
 	* @copyright Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 	* @link http://cakephp.org CakePHP(tm) Project
 	* @package cake
 	* @subpackage cake.cake.libs.view.helpers
 	* @since CakePHP(tm) v 1.2.0
 	* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 	*/
 	 
 	/**
 	* Pagination Helper class for easy generation of pagination links.
 	*
24 	* PaginationHelper encloses all methods needed when working with pagination.
25 	*
26 	* @package cake
27 	* @subpackage cake.cake.libs.view.helpers
28 	* @link http://book.cakephp.org/view/1458/Paginator
29 	*/
30 	class PaginatorHelper extends AppHelper {
31 	 
32 	/**
33 	* Helper dependencies
34 	*
35 	* @var array
36 	*/
37 	var $helpers = array('Html');
38 	 
39 	/**
40 	* Holds the default model for paged recordsets
41 	*
42 	* @var string
43 	*/
44 	var $__defaultModel = null;
45 	 
46 	/**
47 	* The class used for 'Ajax' pagination links.
48 	*
49 	* @var string
50 	*/
51 	var $_ajaxHelperClass = 'Js';
52 	 
53 	/**
54 	* Holds the default options for pagination links
55 	*
56 	* The values that may be specified are:
57 	*
58 	* - `$options['format']` Format of the counter. Supported formats are 'range' and 'pages'
59 	* and custom (default). In the default mode the supplied string is parsed and constants are replaced
60 	* by their actual values.
61 	* Constants: %page%, %pages%, %current%, %count%, %start%, %end% .
62 	* - `$options['separator']` The separator of the actual page and number of pages (default: ' of ').
63 	* - `$options['url']` Url of the action. See Router::url()
64 	* - `$options['url']['sort']` the key that the recordset is sorted.
65 	* - `$options['url']['direction']` Direction of the sorting (default: 'asc').
66 	* - `$options['url']['page']` Page # to display.
67 	* - `$options['model']` The name of the model.
68 	* - `$options['escape']` Defines if the title field for the link should be escaped (default: true).
69 	* - `$options['update']` DOM id of the element updated with the results of the AJAX call.
70 	* If this key isn't specified Paginator will use plain HTML links.
71 	* - `$options['indicator']` DOM id of the element that will be shown when doing AJAX requests. **Only supported by
72 	* AjaxHelper**
73 	*
74 	* @var array
75 	* @access public
76 	*/
77 	var $options = array();
78 	 
79 	/**
80 	* Constructor for the helper. Sets up the helper that is used for creating 'AJAX' links.
81 	*
82 	* Use `var $helpers = array('Paginator' => array('ajax' => 'CustomHelper'));` to set a custom Helper
83 	* or choose a non JsHelper Helper. If you want to use a specific library with JsHelper declare JsHelper and its
84 	* adapter before including PaginatorHelper in your helpers array.
85 	*
86 	* The chosen custom helper must implement a `link()` method.
87 	*
88 	* @return void
89 	*/
90 	function __construct($config = array()) {
91 	$ajaxProvider = isset($config['ajax']) ? $config['ajax'] : 'Js';
92 	$this->helpers[] = $ajaxProvider;
93 	$this->_ajaxHelperClass = $ajaxProvider;
94 	 
95 	App::import('Helper', $ajaxProvider);
96 	$classname = $ajaxProvider . 'Helper';
97 	if (!is_callable(array($classname, 'link'))) {
98 	trigger_error(sprintf(__('%s does not implement a link() method, it is incompatible with PaginatorHelper', true), $classname), E_USER_WARNING);
99 	}
100 	}
101 	 
102 	/**
103 	* Before render callback. Overridden to merge passed args with url options.
104 	*
105 	* @return void
106 	* @access public
107 	*/
108 	function beforeRender() {
109 	$this->options['url'] = array_merge($this->params['pass'], $this->params['named']);
110 	 
111 	parent::beforeRender();
112 	}
113 	 
114 	/**
115 	* Gets the current paging parameters from the resultset for the given model
116 	*
117 	* @param string $model Optional model name. Uses the default if none is specified.
118 	* @return array The array of paging parameters for the paginated resultset.
119 	* @access public
120 	*/
121 	function params($model = null) {
122 	if (empty($model)) {
123 	$model = $this->defaultModel();
124 	}
125 	if (!isset($this->params['paging']) || empty($this->params['paging'][$model])) {
126 	return null;
127 	}
128 	return $this->params['paging'][$model];
129 	}
130 	 
131 	/**
132 	* Sets default options for all pagination links
133 	*
134 	* @param mixed $options Default options for pagination links. If a string is supplied - it
135 	* is used as the DOM id element to update. See PaginatorHelper::$options for list of keys.
136 	* @return void
137 	* @access public
138 	*/
139 	function options($options = array()) {
140 	if (is_string($options)) {
141 	$options = array('update' => $options);
142 	}
143 	 
144 	if (!empty($options['paging'])) {
145 	if (!isset($this->params['paging'])) {
146 	$this->params['paging'] = array();
147 	}
148 	$this->params['paging'] = array_merge($this->params['paging'], $options['paging']);
149 	unset($options['paging']);
150 	}
151 	$model = $this->defaultModel();
152 	 
153 	if (!empty($options[$model])) {
154 	if (!isset($this->params['paging'][$model])) {
155 	$this->params['paging'][$model] = array();
156 	}
157 	$this->params['paging'][$model] = array_merge(
158 	$this->params['paging'][$model], $options[$model]
159 	);
160 	unset($options[$model]);
161 	}
162 	$this->options = array_filter(array_merge($this->options, $options));
163 	}
164 	 
165 	/**
166 	* Gets the current page of the recordset for the given model
167 	*
168 	* @param string $model Optional model name. Uses the default if none is specified.
169 	* @return string The current page number of the recordset.
170 	* @access public
171 	*/
172 	function current($model = null) {
173 	$params = $this->params($model);
174 	 
175 	if (isset($params['page'])) {
176 	return $params['page'];
177 	}
178 	return 1;
179 	}
180 	 
181 	/**
182 	* Gets the current key by which the recordset is sorted
183 	*
184 	* @param string $model Optional model name. Uses the default if none is specified.
185 	* @param mixed $options Options for pagination links. See #options for list of keys.
186 	* @return string The name of the key by which the recordset is being sorted, or
187 	* null if the results are not currently sorted.
188 	* @access public
189 	*/
190 	function sortKey($model = null, $options = array()) {
191 	if (empty($options)) {
192 	$params = $this->params($model);
193 	$options = array_merge($params['defaults'], $params['options']);
194 	}
195 	 
196 	if (isset($options['sort']) && !empty($options['sort'])) {
197 	return $options['sort'];
198 	} elseif (isset($options['order']) && is_array($options['order'])) {
199 	return key($options['order']);
200 	} elseif (isset($options['order']) && is_string($options['order'])) {
201 	return $options['order'];
202 	}
203 	return null;
204 	}
205 	 
206 	/**
207 	* Gets the current direction the recordset is sorted
208 	*
209 	* @param string $model Optional model name. Uses the default if none is specified.
210 	* @param mixed $options Options for pagination links. See #options for list of keys.
211 	* @return string The direction by which the recordset is being sorted, or
212 	* null if the results are not currently sorted.
213 	* @access public
214 	*/
215 	function sortDir($model = null, $options = array()) {
216 	$dir = null;
217 	 
218 	if (empty($options)) {
219 	$params = $this->params($model);
220 	$options = array_merge($params['defaults'], $params['options']);
221 	}
222 	 
223 	if (isset($options['direction'])) {
224 	$dir = strtolower($options['direction']);
225 	} elseif (isset($options['order']) && is_array($options['order'])) {
226 	$dir = strtolower(current($options['order']));
227 	}
228 	 
229 	if ($dir == 'desc') {
230 	return 'desc';
231 	}
232 	return 'asc';
233 	}
234 	 
235 	/**
236 	* Generates a "previous" link for a set of paged records
237 	*
238 	* ### Options:
239 	*
240 	* - `tag` The tag wrapping tag you want to use, defaults to 'span'
241 	* - `escape` Whether you want the contents html entity encoded, defaults to true
242 	* - `model` The model to use, defaults to PaginatorHelper::defaultModel()
243 	*
244 	* @param string $title Title for the link. Defaults to '<< Previous'.
245 	* @param mixed $options Options for pagination link. See #options for list of keys.
246 	* @param string $disabledTitle Title when the link is disabled.
247 	* @param mixed $disabledOptions Options for the disabled pagination link. See #options for list of keys.
248 	* @return string A "previous" link or $disabledTitle text if the link is disabled.
249 	* @access public
250 	*/
251 	function prev($title = '<< Previous', $options = array(), $disabledTitle = null, $disabledOptions = array()) {
252 	return $this->__pagingLink('Prev', $title, $options, $disabledTitle, $disabledOptions);
253 	}
254 	 
255 	/**
256 	* Generates a "next" link for a set of paged records
257 	*
258 	* ### Options:
259 	*
260 	* - `tag` The tag wrapping tag you want to use, defaults to 'span'
261 	* - `escape` Whether you want the contents html entity encoded, defaults to true
262 	* - `model` The model to use, defaults to PaginatorHelper::defaultModel()
263 	*
264 	* @param string $title Title for the link. Defaults to 'Next >>'.
265 	* @param mixed $options Options for pagination link. See above for list of keys.
266 	* @param string $disabledTitle Title when the link is disabled.
267 	* @param mixed $disabledOptions Options for the disabled pagination link. See above for list of keys.
268 	* @return string A "next" link or or $disabledTitle text if the link is disabled.
269 	* @access public
270 	*/
271 	function next($title = 'Next >>', $options = array(), $disabledTitle = null, $disabledOptions = array()) {
272 	return $this->__pagingLink('Next', $title, $options, $disabledTitle, $disabledOptions);
273 	}
274 	 
275 	/**
276 	* Generates a sorting link. Sets named parameters for the sort and direction. Handles
277 	* direction switching automatically.
278 	*
279 	* ### Options:
280 	*
281 	* - `escape` Whether you want the contents html entity encoded, defaults to true
282 	* - `model` The model to use, defaults to PaginatorHelper::defaultModel()
283 	*
284 	* @param string $title Title for the link.
285 	* @param string $key The name of the key that the recordset should be sorted. If $key is null
286 	* $title will be used for the key, and a title will be generated by inflection.
287 	* @param array $options Options for sorting link. See above for list of keys.
288 	* @return string A link sorting default by 'asc'. If the resultset is sorted 'asc' by the specified
289 	* key the returned link will sort by 'desc'.
290 	* @access public
291 	*/
292 	function sort($title, $key = null, $options = array()) {
293 	$options = array_merge(array('url' => array(), 'model' => null), $options);
294 	$url = $options['url'];
295 	unset($options['url']);
296 	 
297 	if (empty($key)) {
298 	$key = $title;
299 	$title = __(Inflector::humanize(preg_replace('/_id$/', '', $title)), true);
300 	}
301 	$dir = isset($options['direction']) ? $options['direction'] : 'asc';
302 	unset($options['direction']);
303 	 
304 	$sortKey = $this->sortKey($options['model']);
305 	$defaultModel = $this->defaultModel();
306 	$isSorted = (
307 	$sortKey === $key ||
308 	$sortKey === $defaultModel . '.' . $key ||
309 	$key === $defaultModel . '.' . $sortKey
310 	);
311 	 
312 	if ($isSorted) {
313 	$dir = $this->sortDir($options['model']) === 'asc' ? 'desc' : 'asc';
314 	$class = $dir === 'asc' ? 'desc' : 'asc';
315 	if (!empty($options['class'])) {
316 	$options['class'] .= ' ' . $class;
317 	} else {
318 	$options['class'] = $class;
319 	}
320 	}
321 	if (is_array($title) && array_key_exists($dir, $title)) {
322 	$title = $title[$dir];
323 	}
324 	 
325 	$url = array_merge(array('sort' => $key, 'direction' => $dir), $url, array('order' => null));
326 	return $this->link($title, $url, $options);
327 	}
328 	 
329 	/**
330 	* Generates a plain or Ajax link with pagination parameters
331 	*
332 	* ### Options
333 	*
334 	* - `update` The Id of the DOM element you wish to update. Creates Ajax enabled links
335 	* with the AjaxHelper.
336 	* - `escape` Whether you want the contents html entity encoded, defaults to true
337 	* - `model` The model to use, defaults to PaginatorHelper::defaultModel()
338 	*
339 	* @param string $title Title for the link.
340 	* @param mixed $url Url for the action. See Router::url()
341 	* @param array $options Options for the link. See #options for list of keys.
342 	* @return string A link with pagination parameters.
343 	* @access public
344 	*/
345 	function link($title, $url = array(), $options = array()) {
346 	$options = array_merge(array('model' => null, 'escape' => true), $options);
347 	$model = $options['model'];
348 	unset($options['model']);
349 	 
350 	if (!empty($this->options)) {
351 	$options = array_merge($this->options, $options);
352 	}
353 	if (isset($options['url'])) {
354 	$url = array_merge((array)$options['url'], (array)$url);
355 	unset($options['url']);
356 	}
357 	$url = $this->url($url, true, $model);
358 	 
359 	$obj = isset($options['update']) ? $this->_ajaxHelperClass : 'Html';
360 	$url = array_merge(array('page' => $this->current($model)), $url);
361 	$url = array_merge(Set::filter($url, true), array_intersect_key($url, array('plugin' => true)));
362 	return $this->{$obj}->link($title, $url, $options);
363 	}
364 	 
365 	/**
366 	* Merges passed URL options with current pagination state to generate a pagination URL.
367 	*
368 	* @param array $options Pagination/URL options array
369 	* @param boolean $asArray Return the url as an array, or a URI string
370 	* @param string $model Which model to paginate on
371 	* @return mixed By default, returns a full pagination URL string for use in non-standard contexts (i.e. JavaScript)
372 	* @access public
373 	*/
374 	function url($options = array(), $asArray = false, $model = null) {
375 	$paging = $this->params($model);
376 	$url = array_merge(array_filter(Set::diff(array_merge(
377 	$paging['defaults'], $paging['options']), $paging['defaults'])), $options
378 	);
379 	 
380 	if (isset($url['order'])) {
381 	$sort = $direction = null;
382 	if (is_array($url['order'])) {
383 	list($sort, $direction) = array($this->sortKey($model, $url), current($url['order']));
384 	}
385 	unset($url['order']);
386 	$url = array_merge($url, compact('sort', 'direction'));
387 	}
388 	 
389 	if ($asArray) {
390 	return $url;
391 	}
392 	return parent::url($url);
393 	}
394 	 
395 	/**
396 	* Protected method for generating prev/next links
397 	*
398 	* @access protected
399 	*/
400 	function __pagingLink($which, $title = null, $options = array(), $disabledTitle = null, $disabledOptions = array()) {
401 	$check = 'has' . $which;
402 	$_defaults = array(
403 	'url' => array(), 'step' => 1, 'escape' => true,
404 	'model' => null, 'tag' => 'span', 'class' => strtolower($which)
405 	);
406 	$options = array_merge($_defaults, (array)$options);
407 	$paging = $this->params($options['model']);
408 	if (empty($disabledOptions)) {
409 	$disabledOptions = $options;
410 	}
411 	 
412 	if (!$this->{$check}($options['model']) && (!empty($disabledTitle) || !empty($disabledOptions))) {
413 	if (!empty($disabledTitle) && $disabledTitle !== true) {
414 	$title = $disabledTitle;
415 	}
416 	$options = array_merge($_defaults, (array)$disabledOptions);
417 	} elseif (!$this->{$check}($options['model'])) {
418 	return null;
419 	}
420 	 
421 	foreach (array_keys($_defaults) as $key) {
422 	${$key} = $options[$key];
423 	unset($options[$key]);
424 	}
425 	$url = array_merge(array('page' => $paging['page'] + ($which == 'Prev' ? $step * -1 : $step)), $url);
426 	 
427 	if ($this->{$check}($model)) {
428 	return $this->Html->tag($tag, $this->link($title, $url, array_merge($options, compact('escape', 'class'))));
429 	} else {
430 	return $this->Html->tag($tag, $title, array_merge($options, compact('escape', 'class')));
431 	}
432 	}
433 	 
434 	/**
435 	* Returns true if the given result set is not at the first page
436 	*
437 	* @param string $model Optional model name. Uses the default if none is specified.
438 	* @return boolean True if the result set is not at the first page.
439 	* @access public
440 	*/
441 	function hasPrev($model = null) {
442 	return $this->__hasPage($model, 'prev');
443 	}
444 	 
445 	/**
446 	* Returns true if the given result set is not at the last page
447 	*
448 	* @param string $model Optional model name. Uses the default if none is specified.
449 	* @return boolean True if the result set is not at the last page.
450 	* @access public
451 	*/
452 	function hasNext($model = null) {
453 	return $this->__hasPage($model, 'next');
454 	}
455 	 
456 	/**
457 	* Returns true if the given result set has the page number given by $page
458 	*
459 	* @param string $model Optional model name. Uses the default if none is specified.
460 	* @param int $page The page number - if not set defaults to 1.
461 	* @return boolean True if the given result set has the specified page number.
462 	* @access public
463 	*/
464 	function hasPage($model = null, $page = 1) {
465 	if (is_numeric($model)) {
466 	$page = $model;
467 	$model = null;
468 	}
469 	$paging = $this->params($model);
470 	return $page <= $paging['pageCount'];
471 	}
472 	 
473 	/**
474 	* Does $model have $page in its range?
475 	*
476 	* @param string $model Model name to get parameters for.
477 	* @param integer $page Page number you are checking.
478 	* @return boolean Whether model has $page
479 	* @access protected
480 	*/
481 	function __hasPage($model, $page) {
482 	$params = $this->params($model);
483 	if (!empty($params)) {
484 	if ($params["{$page}Page"] == true) {
485 	return true;
486 	}
487 	}
488 	return false;
489 	}
490 	 
491 	/**
492 	* Gets the default model of the paged sets
493 	*
494 	* @return string Model name or null if the pagination isn't initialized.
495 	* @access public
496 	*/
497 	function defaultModel() {
498 	if ($this->__defaultModel != null) {
499 	return $this->__defaultModel;
500 	}
501 	if (empty($this->params['paging'])) {
502 	return null;
503 	}
504 	list($this->__defaultModel) = array_keys($this->params['paging']);
505 	return $this->__defaultModel;
506 	}
507 	 
508 	/**
509 	* Returns a counter string for the paged result set
510 	*
511 	* ### Options
512 	*
513 	* - `model` The model to use, defaults to PaginatorHelper::defaultModel();
514 	* - `format` The format string you want to use, defaults to 'pages' Which generates output like '1 of 5'
515 	* set to 'range' to generate output like '1 - 3 of 13'. Can also be set to a custom string, containing
516 	* the following placeholders `%page%`, `%pages%`, `%current%`, `%count%`, `%start%`, `%end%` and any
517 	* custom content you would like.
518 	* - `separator` The separator string to use, default to ' of '
519 	*
520 	* @param mixed $options Options for the counter string. See #options for list of keys.
521 	* @return string Counter string.
522 	* @access public
523 	*/
524 	function counter($options = array()) {
525 	if (is_string($options)) {
526 	$options = array('format' => $options);
527 	}
528 	 
529 	$options = array_merge(
530 	array(
531 	'model' => $this->defaultModel(),
532 	'format' => 'pages',
533 	'separator' => __(' of ', true)
534 	),
535 	$options);
536 	 
537 	$paging = $this->params($options['model']);
538 	if ($paging['pageCount'] == 0) {
539 	$paging['pageCount'] = 1;
540 	}
541 	$start = 0;
542 	if ($paging['count'] >= 1) {
543 	$start = (($paging['page'] - 1) * $paging['options']['limit']) + 1;
544 	}
545 	$end = $start + $paging['options']['limit'] - 1;
546 	if ($paging['count'] < $end) {
547 	$end = $paging['count'];
548 	}
549 	 
550 	switch ($options['format']) {
551 	case 'range':
552 	if (!is_array($options['separator'])) {
553 	$options['separator'] = array(' - ', $options['separator']);
554 	}
555 	$out = $start . $options['separator'][0] . $end . $options['separator'][1];
556 	$out .= $paging['count'];
557 	break;
558 	case 'pages':
559 	$out = $paging['page'] . $options['separator'] . $paging['pageCount'];
560 	break;
561 	default:
562 	$map = array(
563 	'%page%' => $paging['page'],
564 	'%pages%' => $paging['pageCount'],
565 	'%current%' => $paging['current'],
566 	'%count%' => $paging['count'],
567 	'%start%' => $start,
568 	'%end%' => $end
569 	);
570 	$out = str_replace(array_keys($map), array_values($map), $options['format']);
571 	 
572 	$newKeys = array(
573 	'{:page}', '{:pages}', '{:current}', '{:count}', '{:start}', '{:end}'
574 	);
575 	$out = str_replace($newKeys, array_values($map), $out);
576 	break;
577 	}
578 	return $out;
579 	}
580 	 
581 	/**
582 	* Returns a set of numbers for the paged result set
583 	* uses a modulus to decide how many numbers to show on each side of the current page (default: 8)
584 	*
585 	* ### Options
586 	*
587 	* - `before` Content to be inserted before the numbers
588 	* - `after` Content to be inserted after the numbers
589 	* - `model` Model to create numbers for, defaults to PaginatorHelper::defaultModel()
590 	* - `modulus` how many numbers to include on either side of the current page, defaults to 8.
591 	* - `separator` Separator content defaults to ' | '
592 	* - `tag` The tag to wrap links in, defaults to 'span'
593 	* - `first` Whether you want first links generated, set to an integer to define the number of 'first'
594 	* links to generate
595 	* - `last` Whether you want last links generated, set to an integer to define the number of 'last'
596 	* links to generate
597 	*
598 	* @param mixed $options Options for the numbers, (before, after, model, modulus, separator)
599 	* @return string numbers string.
600 	* @access public
601 	*/
602 	function numbers($options = array()) {
603 	if ($options === true) {
604 	$options = array(
605 	'before' => ' | ', 'after' => ' | ', 'first' => 'first', 'last' => 'last'
606 	);
607 	}
608 	 
609 	$defaults = array(
610 	'tag' => 'span', 'before' => null, 'after' => null, 'model' => $this->defaultModel(),
611 	'modulus' => '8', 'separator' => ' | ', 'first' => null, 'last' => null,
612 	);
613 	$options += $defaults;
614 	 
615 	$params = (array)$this->params($options['model']) + array('page'=> 1);
616 	unset($options['model']);
617 	 
618 	if ($params['pageCount'] <= 1) {
619 	return false;
620 	}
621 	 
622 	extract($options);
623 	unset($options['tag'], $options['before'], $options['after'], $options['model'],
624 	$options['modulus'], $options['separator'], $options['first'], $options['last']);
625 	 
626 	$out = '';
627 	 
628 	if ($modulus && $params['pageCount'] > $modulus) {
629 	$half = intval($modulus / 2);
630 	$end = $params['page'] + $half;
631 	 
632 	if ($end > $params['pageCount']) {
633 	$end = $params['pageCount'];
634 	}
635 	$start = $params['page'] - ($modulus - ($end - $params['page']));
636 	if ($start <= 1) {
637 	$start = 1;
638 	$end = $params['page'] + ($modulus - $params['page']) + 1;
639 	}
640 	 
641 	if ($first && $start > 1) {
642 	$offset = ($start <= (int)$first) ? $start - 1 : $first;
643 	if ($offset < $start - 1) {
644 	$out .= $this->first($offset, array('tag' => $tag, 'separator' => $separator));
645 	} else {
646 	$out .= $this->first($offset, array('tag' => $tag, 'after' => $separator, 'separator' => $separator));
647 	}
648 	}
649 	 
650 	$out .= $before;
651 	 
652 	for ($i = $start; $i < $params['page']; $i++) {
653 	$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), $options))
654 	. $separator;
655 	}
656 	 
657 	$out .= $this->Html->tag($tag, $params['page'], array('class' => 'current'));
658 	if ($i != $params['pageCount']) {
659 	$out .= $separator;
660 	}
661 	 
662 	$start = $params['page'] + 1;
663 	for ($i = $start; $i < $end; $i++) {
664 	$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), $options))
665 	. $separator;
666 	}
667 	 
668 	if ($end != $params['page']) {
669 	$out .= $this->Html->tag($tag, $this->link($i, array('page' => $end), $options));
670 	}
671 	 
672 	$out .= $after;
673 	 
674 	if ($last && $end < $params['pageCount']) {
675 	$offset = ($params['pageCount'] < $end + (int)$last) ? $params['pageCount'] - $end : $last;
676 	if ($offset <= $last && $params['pageCount'] - $end > $offset) {
677 	$out .= $this->last($offset, array('tag' => $tag, 'separator' => $separator));
678 	} else {
679 	$out .= $this->last($offset, array('tag' => $tag, 'before' => $separator, 'separator' => $separator));
680 	}
681 	}
682 	 
683 	} else {
684 	$out .= $before;
685 	 
686 	for ($i = 1; $i <= $params['pageCount']; $i++) {
687 	if ($i == $params['page']) {
688 	$out .= $this->Html->tag($tag, $i, array('class' => 'current'));
689 	} else {
690 	$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), $options));
691 	}
692 	if ($i != $params['pageCount']) {
693 	$out .= $separator;
694 	}
695 	}
696 	 
697 	$out .= $after;
698 	}
699 	 
700 	return $out;
701 	}
702 	 
703 	/**
704 	* Returns a first or set of numbers for the first pages
705 	*
706 	* ### Options:
707 	*
708 	* - `tag` The tag wrapping tag you want to use, defaults to 'span'
709 	* - `before` Content to insert before the link/tag
710 	* - `model` The model to use defaults to PaginatorHelper::defaultModel()
711 	* - `separator` Content between the generated links, defaults to ' | '
712 	*
713 	* @param mixed $first if string use as label for the link, if numeric print page numbers
714 	* @param mixed $options
715 	* @return string numbers string.
716 	* @access public
717 	*/
718 	function first($first = '<< first', $options = array()) {
719 	$options = array_merge(
720 	array(
721 	'tag' => 'span',
722 	'after'=> null,
723 	'model' => $this->defaultModel(),
724 	'separator' => ' | ',
725 	),
726 	(array)$options);
727 	 
728 	$params = array_merge(array('page'=> 1), (array)$this->params($options['model']));
729 	unset($options['model']);
730 	 
731 	if ($params['pageCount'] <= 1) {
732 	return false;
733 	}
734 	extract($options);
735 	unset($options['tag'], $options['after'], $options['model'], $options['separator']);
736 	 
737 	$out = '';
738 	 
739 	if (is_int($first) && $params['page'] > $first) {
740 	if ($after === null) {
741 	$after = '...';
742 	}
743 	for ($i = 1; $i <= $first; $i++) {
744 	$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), $options));
745 	if ($i != $first) {
746 	$out .= $separator;
747 	}
748 	}
749 	$out .= $after;
750 	} elseif ($params['page'] > 1) {
751 	$out = $this->Html->tag($tag, $this->link($first, array('page' => 1), $options))
752 	. $after;
753 	}
754 	return $out;
755 	}
756 	 
757 	/**
758 	* Returns a last or set of numbers for the last pages
759 	*
760 	* ### Options:
761 	*
762 	* - `tag` The tag wrapping tag you want to use, defaults to 'span'
763 	* - `before` Content to insert before the link/tag
764 	* - `model` The model to use defaults to PaginatorHelper::defaultModel()
765 	* - `separator` Content between the generated links, defaults to ' | '
766 	*
767 	* @param mixed $last if string use as label for the link, if numeric print page numbers
768 	* @param mixed $options Array of options
769 	* @return string numbers string.
770 	* @access public
771 	*/
772 	function last($last = 'last >>', $options = array()) {
773 	$options = array_merge(
774 	array(
775 	'tag' => 'span',
776 	'before'=> null,
777 	'model' => $this->defaultModel(),
778 	'separator' => ' | ',
779 	),
780 	(array)$options);
781 	 
782 	$params = array_merge(array('page'=> 1), (array)$this->params($options['model']));
783 	unset($options['model']);
784 	 
785 	if ($params['pageCount'] <= 1) {
786 	return false;
787 	}
788 	 
789 	extract($options);
790 	unset($options['tag'], $options['before'], $options['model'], $options['separator']);
791 	 
792 	$out = '';
793 	$lower = $params['pageCount'] - $last + 1;
794 	 
795 	if (is_int($last) && $params['page'] < $lower) {
796 	if ($before === null) {
797 	$before = '...';
798 	}
799 	for ($i = $lower; $i <= $params['pageCount']; $i++) {
800 	$out .= $this->Html->tag($tag, $this->link($i, array('page' => $i), $options));
801 	if ($i != $params['pageCount']) {
802 	$out .= $separator;
803 	}
804 	}
805 	$out = $before . $out;
806 	} elseif ($params['page'] < $params['pageCount']) {
807 	$out = $before . $this->Html->tag(
808 	$tag, $this->link($last, array('page' => $params['pageCount']), $options
809 	));
810 	}
811 	return $out;
812 	}
813 	}
814 	 
815 	 
© 2010 Cake Software Foundation CakePHP : Rapid Development Framework
