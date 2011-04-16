Colony PHP Framework
====================

Colony is a very lightweight, minimalist MVC framework for PHP. It is designed to be extensible and customizable for a variety of environments, but primary development is focused on a view layer backed by [Smarty](http://www.smarty.net) and model layer backed by [Propel](http://www.propelorm.org).

Speed is the primary focus of the project, both when it comes to runtime execution and application development. The framework sets up a development pattern and then gets out of your way. As a result, it is very small in size and adds very little overhead to execution. 

Formerly known as ASOworx.

Installation
------------

To avoid a troublesome setup process and issues with stepping on existing files in git, we've broken colony into two repositories: colony and colony-scaffold. The core library code is in the first repository; the scaffolding required for an application to run is in the second. It is recommended when starting a new project based on colony, that you check out the scaffolding code to base your project on. This will set up the library as a git submodule, which you can update independently from your application code as new code is made available. Simply run the following:

	git clone git@github.com:armyofbees/colony-scaffold.git .
	git submodule init
	git submodule update

You will now have your application scaffolding ready to customize for your particular app. If colony is updated and you wish to use that update in your application, you can update with "git submodule update". Read the full git-submodule(1) documentation for full details on how submodules work and to get some idea of the tricks you can do with them.

License
-------

Copyright (c) Army of Bees (www.armyofbees.com)

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