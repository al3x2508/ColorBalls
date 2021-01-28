<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BallsController extends Controller
{
    public function api(Request $request)
    {
        $colorsBalls = $request->input('balls');
        $noOfColors = count($colorsBalls);
        $groups = [];
        /*
         * Assuming we have an array like [4, 3, 7, 2, 9]
         */
        $i = 0;
        //Check if we have enough balls to arrange them at least into 2 separate groups
        if (array_sum($colorsBalls) > 1 && array_sum($colorsBalls) == pow($noOfColors, 2)) {
            //While we still have to populate groups based on the n total of colors
            while (count($groups) < $noOfColors) {
                //We will try first to get the sets of balls that can provide exactly the number of the group (in our case, n = 5)
                foreach ($colorsBalls as $colorIndex => &$ballsOfColor) {
                    foreach ($colorsBalls as $colorIndex2 => &$ballsOfColor2) {
                        //Check if we don't combine the same color and if the colors combined gives us exactly n balls
                        if ($colorIndex != $colorIndex2 && $ballsOfColor > 0 && $ballsOfColor2 > 0 && $ballsOfColor + $ballsOfColor2 == $noOfColors) {
                            $groups[$i] = str_repeat(chr($colorIndex + 65), $ballsOfColor) . str_repeat(chr($colorIndex2 + 65),
                                    $ballsOfColor2);
                            $i++;
                            $ballsOfColor = 0;
                            $ballsOfColor2 = 0;
                            break 2;
                        }
                    }
                }
                //Now we will check what colors we can combine so we can create a new group of n balls, even the combination leaves some rest from the second color
                foreach ($colorsBalls as $colorIndex => &$ballsOfColor) {
                    foreach ($colorsBalls as $colorIndex2 => &$ballsOfColor2) {
                        if ($colorIndex != $colorIndex2 && $ballsOfColor > 0 && $ballsOfColor2 > 0 && $ballsOfColor + $ballsOfColor2 > $noOfColors) {
                            if ($ballsOfColor >= $noOfColors) {
                                $groups[$i] = str_repeat(chr($colorIndex + 65), $noOfColors);
                                $i++;
                                $ballsOfColor = $ballsOfColor - $noOfColors;
                            } else {
                                $groups[$i] = str_repeat(chr($colorIndex + 65),
                                        $ballsOfColor) . str_repeat(chr($colorIndex2 + 65), ($noOfColors - $ballsOfColor));
                                $i++;
                                $ballsOfColor2 = $ballsOfColor2 - ($noOfColors - $ballsOfColor);
                                $ballsOfColor = 0;
                            }
                        }
                    }
                }
                //Now we will add the remaining rests of the balls
                foreach ($colorsBalls as $colorIndex => &$ballsOfColor) {
                    if ($ballsOfColor >= $noOfColors) {
                        $groups[$i] = str_repeat(chr($colorIndex + 65), $noOfColors);
                        $i++;
                        $ballsOfColor = $ballsOfColor - ($noOfColors - $ballsOfColor);
                    }
                }
            }
            return array('status' => true, 'groups' => $groups);
        } else {
            return array('status' => false, 'message' => 'Error: not enough balls');
        }
    }
}
