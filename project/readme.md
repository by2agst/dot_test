## Logika dan Struktur Data

```
$s = [2, 1, 6, 9, 9, 4, 3];
foreach ($s as $key => &$value) {
	$value = (int) $value;
}
$s = array_unique($s);
rsort($s, SORT_NUMERIC);
foreach ($s as $key => $value) {
	$second_highest = $value;
	if($key == 1) break;
}
echo $second_highest;
```