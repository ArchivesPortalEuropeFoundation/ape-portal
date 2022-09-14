<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'The MIT License (MIT)

Copyright (c) 2018 Mark Hamstra Web Development <support@modmore.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
',
    'readme' => 'MagicPreview for MODX
---------------------

MagicPreview adds a _Magical_ Preview button to the resources panel which will
show you, without actually saving the resource, a real preview of a resource.

It also has responsive breakpoints, so you can preview your page on various widths.
',
    'changelog' => 'MagicPreview 1.0.1-pl
---------------------
Released on 2018-12-18

- Add loading animation [#6]
- Rewrite CSS to BEM standards, reduce header size [#5]
- Add version-based cache busting to js and css files

MagicPreview 1.0.0-pl
---------------------
Released on 2018-12-17

- First magical release!
',
    'setup-options' => 'magicpreview-1.0.1-pl/setup-options.php',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '069b54477834155c43c6a42f69179e1f',
      'native_key' => 'magicpreview',
      'filename' => 'modNamespace/a298535cd1d6087713fb628adb2bbcfc.vehicle',
      'namespace' => 'magicpreview',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => 'abf498a627ebb96b6f59df252b990054',
      'native_key' => 'abf498a627ebb96b6f59df252b990054',
      'filename' => 'xPDOFileVehicle/7a9b76006320dc0b2c6d6b04e3427735.vehicle',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => '2555b22dcb379cd2753ac9f6a1eca64a',
      'native_key' => '2555b22dcb379cd2753ac9f6a1eca64a',
      'filename' => 'xPDOFileVehicle/3e42c092c5955c552bc5bd09f0a0cb60.vehicle',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modPlugin',
      'guid' => '8d1f91d32545391ffdad1624405858ee',
      'native_key' => 1,
      'filename' => 'modPlugin/cf34dd107f1c764e49496d61d1fc437d.vehicle',
      'namespace' => 'magicpreview',
    ),
  ),
);