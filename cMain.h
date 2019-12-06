#pragma once

// Include wxWidgets library.
#include "wx/wx.h"
#include "wx/listbox.h"

// Windows size functions.
#include "wTypes.h"

// Include external application header files.
#include "UINavigator.h"

// Windows specific includes.
#include <Windows.h>

class cMain : public wxFrame
{
public:
	cMain();
	~cMain();

	// Window Size variables.
	int screenWidth;
	int screenHeight;

	// Husky game logo variables.
	wxPNGHandler*   logoHandler;
	wxStaticBitmap* logoImage;
	wxPoint         logoPosition;
	wxPoint         logoOffset;
	wxString        logoPathName;
	wxWindowID      logoID;
	wxWindowID      logoParentID;
	int             logoWidth;
	int             logoHeight;

	// List box variables.
	int              numberOfGames;
	int              gameIterator;
	vector<wxString> gameVector;
	wxListBox*       gameSelectionBox;
	UINavigator*     navigator;
	string           selectedGame;

private:
	// Handle keyboard input events.
	void KeyHandler(wxKeyEvent& event);

};

