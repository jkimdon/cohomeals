END {$ff.close if $ff} # close ff at completion of the tests

# libraries used by feature tests
require 'firewatir'
require 'test/unit'
require 'test/unit/ui/console/testrunner'
require 'firewatir/testUnitAddons'

topdir = File.join(File.dirname(__FILE__), '..')
Dir.chdir topdir do
#  $all_tests = Dir["unittest/*_test.rb"]
  $all_tests = Dir["unittest/adduser_test.rb"]
end

def start_ff_with_logger
  $ff = FireWatir::Firefox.new()
end

def set_local_dir
  $htmlRoot =  "http://moo/cohomeals/"
end

start_ff_with_logger
set_local_dir
