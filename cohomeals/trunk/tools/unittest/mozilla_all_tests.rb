
TOPDIR = File.join(File.dirname(__FILE__), '..')
$LOAD_PATH.unshift('/var/lib/gems/1.8/gems/firewatir-1.1')
$LOAD_PATH.unshift TOPDIR

require 'unittest/setup.rb'

Dir.chdir TOPDIR

$all_tests.each {|x| require x }

