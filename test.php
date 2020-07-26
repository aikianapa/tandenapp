<?php

$day1Products = [
    ["name" => "1", "value" => 3, "cost" => 200],
    ["name" => "2", "value" => 33, "cost" => 100],
    ["name" => "3", "value" => 100, "cost" => 250],
    ["name" => "4", "value" => 10, "cost" => 500],
    ["name" => "5", "value" => 90, "cost" => 125],
];
$day2Products = [
    ["name" => "1", "value" => 2, "cost" => 1],
    ["name" => "2", "value" => 1000, "cost" => 1000],
];
$day3Products = [
    ["name" => "1", "value" => 99, "cost" => 1000],
    ["name" => "2", "value" => 95, "cost" => 100],
    ["name" => "3", "value" => 85, "cost" => 400],
    ["name" => "4", "value" => 15, "cost" => 500],
    ["name" => "5", "value" => 85, "cost" => 400],
    ["name" => "6", "value" => 85, "cost" => 400],
    ["name" => "7", "value" => 15, "cost" => 100],
    ["name" => "8", "value" => 20, "cost" => 50],
    ["name" => "9", "value" => 20, "cost" => 70],
    ["name" => "10", "value" => 25, "cost" => 50],
    ["name" => "11", "value" => 20, "cost" => 60],
];

print_r(maximizeValue($day1Products,1000));
echo "<br />";
print_r(maximizeValue($day2Products,1000));
echo "<br />";
print_r(maximizeValue($day3Products,1000));

function maximizeValue($products, $money = 1000) {
    // пишите код тут

  usort($products,create_function('$a,$b','return -($a["value"] - $b["value"]);'));

	$max = [];
	$count = count($products);
	$maxidx = 0;
	$maxval = 0;
	for ($i=0; $i<$count; $i++) {
  		$cost = 0;
  		$value = 0;
  		$res = [];
    	foreach($products as $prod) {
    		if ($cost + $prod['cost'] > $money) break;
    		$value += $prod['value'];
    		$cost += $prod['cost'];
    		$res[] = $prod;
    	}
    	$max[$i] = [$value,$cost,$res];
      if ($value > $maxval) {
          $maxval = $value;
          $maxidx = $i;
      }
      $first = array_shift($products);
      $products[] = $first;
	}
	return $max[$maxidx][2];
}



?>
