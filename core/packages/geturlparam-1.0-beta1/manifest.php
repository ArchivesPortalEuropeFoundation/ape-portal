<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'The MIT License

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

Software Copyright (c) 2010 Paul Merchant
',
    'readme' => 'getUrlParam

A simple snippet that will return a value passed through a URL parameter. The Parameter
is sanitized and kept below a set size.

Revolution makes it easy to pass URL parameters (i.e. [[~123? &p=`yes`]]). This snippet
makes it simple to use that URL parameter.

@ author Paul Merchant
@ copyright 2010 Paul Merchant
@ version 1.0 beta1 - October 15, 2010
@ MIT License

OPTIONS
name - The parameter name, defaults to "p"
int - (Opt) Set as true to only allow integer values
max - (Opt) The maximum length of the returned value, defaults to 20
default - (Opt) The value returned if no URL parameter is found

Example: [[getUrlParam? &name=`pageid` &int=`1`]]


',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'dc2675795e816467558c341fa1aa96d4',
      'native_key' => 'geturlparam',
      'filename' => 'modNamespace/878ca8193489fc1a03f0c510e8a76060.vehicle',
      'namespace' => 'geturlparam',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '578d1f4cbacbfa614e1ccba071d70cf3',
      'native_key' => 1,
      'filename' => 'modCategory/88d318d6b42fe64848ae1d093a4db406.vehicle',
      'namespace' => 'geturlparam',
    ),
  ),
);