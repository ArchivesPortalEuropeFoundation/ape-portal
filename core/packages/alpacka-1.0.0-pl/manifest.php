<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'readme' => 'Alpacka contains common functionality that is shared between MODX packages developed by modmore. Those other packages require Alpacka to be installed, so it is automatically installed for you when installing such a package.

Packages that depend on Alpacka include:

- ContentBlocks
- Redactor
- MoreGallery

Other packages, including third party packages not developed by modmore, may also depend on Alpacka.
',
    'license' => 'The MIT License (MIT)
Copyright (c) 2016 modmore, a registered brand of Mark Hamstra Web Development

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
',
    'changelog' => '++ Alpaca 1.0.0-pl
++ Released on 2018-01-22
+++++++++++++++++++++++++
- Make sure left-over placeholders are removed in parsePathPlaceholders
- Read assets_url and core_path from settings before using config constants [S9752]

++ Alpaca 0.4.0-rc2
++ Released on 2016-08-04
+++++++++++++++++++++++++
- Fix fatal errors on installs that have a renamed core folder

++ Alpaca 0.4.0-rc1
++ Released on 2016-08-01
+++++++++++++++++++++++++
- Now available as a MODX Extra (transport package) for shared installations.',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'f8f50d54de1ca30424d761bf5bb37abc',
      'native_key' => 'alpacka',
      'filename' => 'modNamespace/76cbd2f1496ec2308bc5fda34ba57083.vehicle',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => '9a9f280e7f1b45d7d217517093b07c84',
      'native_key' => '9a9f280e7f1b45d7d217517093b07c84',
      'filename' => 'xPDOFileVehicle/9af04e3e83f22195fb28fc6881da002b.vehicle',
    ),
  ),
);