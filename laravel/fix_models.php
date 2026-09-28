<?php
$files = glob('app/Models/*.php');
foreach ($files as $file) {
    if (strpos($file, 'User.php') !== false) continue;
    $content = file_get_contents($file);
    if (strpos($content, '$guarded') === false) {
        // Just adding mass assignment protection bypass
        $content = str_replace('use HasFactory;', "use HasFactory;\n    protected \$guarded = [];\n", $content);
        file_put_contents($file, $content);
    }
}
// Add relation to Customer specifically
$customerFile = 'app/Models/Customer.php';
$cContent = file_get_contents($customerFile);
if (strpos($cContent, 'public function pets') === false) {
    $cContent = str_replace('}', "    public function pets() { return \$this->hasMany(Pet::class); }\n}", $cContent);
    file_put_contents($customerFile, $cContent);
}
echo "Models fixed.\n";
