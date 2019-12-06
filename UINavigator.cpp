#include "UINavigator.h"

vector<wxString> UINavigator::GameList()
{

	//create vector to store game names and returning
	vector<wxString> games;

	//Have to edit hardcoded path for aracade cabinet games folder 
	std::string path = "C:/Users/Matthew/source/repos/ArcadeCabinetGUI/ArcadeCabinetGUI/Games";

	//Loop over all files in the given file path above
	for (const auto & entry : directory_iterator(path))
	{
		//add game names to vector 
		games.push_back(entry.path().filename().string());
		
	}

	//return list of game names 
	return games;
}

void UINavigator::ExecGame(string game)
{
	//string for path to game exe 
	std::string fullpath;

	//temp string for checking if a given file is exe
	std::string exeStr;

	//string var to attach to path in order to execute exe
	std::string exeFile;

	//Have to edit hardcoded path for aracade cabinet games folder 
	std::string path = "C:/Users/Matthew/source/repos/ArcadeCabinetGUI/ArcadeCabinetGUI/Games";

	//string building start of path to loop over in order to find .exe
	fullpath = path + "/" + game;

	//Loop over all files in the given file path above
	for (const auto & entry : directory_iterator(fullpath))
	{

		//grab all file extensions that exist in the current directory
		exeStr = entry.path().filename().extension().string();

		//check if given file extension is .exe
		if (strcmp(exeStr.c_str(), ".exe") == 0)
		{

			//set string to found .exe file
			exeFile = entry.path().filename().string();
		}
	}

	//string build the rest of the path 
	fullpath += "/" + exeFile;

	//execute the executable for the game
	system(fullpath.c_str());
}