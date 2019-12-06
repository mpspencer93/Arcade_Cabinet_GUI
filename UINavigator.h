#pragma once
// Include wxWidgets library
#include "wx/wx.h"

// Windows system includes
#include <string>
#include <iostream>
#include <sstream>
#include <filesystem>
#include <vector>
#include <stdio.h>
#include <Windows.h>

using namespace std;
using namespace std::experimental::filesystem;

class UINavigator
{
public:

	// Within the game directory, return the name of each game within a vector. 
	// A vector is like a doubly linked array structure within c++.
	vector<wxString> GameList();

	// This function will take the name of the game, go into its folder, and execture the
	// game for the user to play.
	void ExecGame(string game);

};