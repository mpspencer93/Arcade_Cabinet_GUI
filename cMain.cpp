#include "cMain.h"

// Constructor.
cMain::cMain() : wxFrame(nullptr, wxID_ANY, "HGD Arcade Cabinet", wxDefaultPosition, wxDefaultSize, wxFULLSCREEN_NOMENUBAR)
{
	// Initialize window variables
	screenWidth  = GetSystemMetrics(SM_CXSCREEN);
	screenHeight = GetSystemMetrics(SM_CYSCREEN);

	// Set the window to full screen and colour.
	wxTopLevelWindow::Maximize(true);
	SetBackgroundColour(*wxWHITE);

	// Initialize HGD logo variables.
	logoID       = 0;
	logoParentID = 0;
	logoWidth    = 225;
	logoHeight   = 225;
	logoOffset   = wxPoint(-300, -200);
	logoPosition = wxPoint((screenWidth / 2) - (logoWidth / 2), (screenHeight / 2) - (logoHeight / 2));
	logoPathName = "C:/Users/Matthew/source/repos/ArcadeCabinetGUI/ArcadeCabinetGUI/Pictures/logo.png";

	// Load HGD logo and place within the window.
	wxInitAllImageHandlers();
	logoHandler = new wxPNGHandler;
	wxImage::AddHandler(logoHandler);
	logoImage = new wxStaticBitmap(this, wxID_ANY, wxBitmap(logoPathName, wxBITMAP_TYPE_PNG), logoPosition + logoOffset, wxSize(logoWidth, logoHeight));
	logoImage->Show();

	// Initialize array for the game list and get them from the folder.
	gameVector    = navigator->GameList();
	numberOfGames = gameVector.size();
	wxString gameArray[10000]; // Initialize game Array memory.
	for (int i = 0; i < numberOfGames; i++)
	{
		gameArray[i] = gameVector.at(i);
	}

	// Initialize and place a listbox below the HGD logo.
	gameSelectionBox = new wxListBox(this, wxID_ANY, wxPoint((screenWidth / 2) - 145, (screenHeight / 2) + 150) + logoOffset, wxSize(300, 350), numberOfGames, gameArray, wxLB_NEEDED_SB);
	gameSelectionBox->Show();
	gameIterator = 0;
	gameSelectionBox->SetSelection(gameIterator); // Autoselect the first game.
	
	Bind(wxEVT_CHAR_HOOK, &cMain::KeyHandler, this);
}

// Deconstructor.
cMain::~cMain()
{
}

// Keyboard input handler.
void cMain::KeyHandler(wxKeyEvent& event)
{
	int key = event.GetKeyCode();

	// Move Up
	if (key == 87 || key == WXK_UP)
	{
		if (gameIterator - 1 >= 0)
		{
			gameIterator--;
			gameSelectionBox->SetSelection(gameIterator);
		}
	}

	// Move Down
	if (key == 83 || key == WXK_DOWN)
	{
		if (gameIterator + 1 < numberOfGames)
		{
			gameIterator++;
			gameSelectionBox->SetSelection(gameIterator);

		}
	}

	// Launch game
	if (key == 70 || key == 49)
	{
		selectedGame = gameSelectionBox->GetString(gameIterator).ToStdString();
		navigator->ExecGame(selectedGame);
	}

	// Exit
	if (event.GetKeyCode() == WXK_ESCAPE)
	{
		exit(0);
	}

}

