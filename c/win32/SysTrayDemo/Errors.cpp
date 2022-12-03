
#include "Errors.h"
#include "stdafx.h"


void showerr(HWND hWnd, LPCWSTR caption, LPCWSTR msg) {
	MessageBox(hWnd, msg, caption, MB_OK | MB_ICONERROR);
}
void handleShellExecuteErrors(HWND hWnd, HINSTANCE openbrowserop) {
	switch ((long)openbrowserop) {
	case 0: showerr(hWnd, _T("Cannot open site"), _T("The operating system is out of memory or resources."));    break;
	case ERROR_BAD_FORMAT:       showerr(hWnd, _T("Cannot open site"), _T("The .exe file is invalid (non-Win32 .exe or error in .exe image)."));         break;
	case SE_ERR_ACCESSDENIED:    showerr(hWnd, _T("Cannot open site"), _T("The operating system denied access to the specified file.")); break;
	case SE_ERR_ASSOCINCOMPLETE: showerr(hWnd, _T("Cannot open site"), _T("The file name association is incomplete or invalid."));       break;
	case SE_ERR_DDEBUSY:         showerr(hWnd, _T("Cannot open site"), _T("The DDE transaction could not be completed because other DDE transactions were being processed.")); break;
	case SE_ERR_DDEFAIL:         showerr(hWnd, _T("Cannot open site"), _T("The DDE transaction failed."));       break;
	case SE_ERR_DDETIMEOUT:      showerr(hWnd, _T("Cannot open site"), _T("The DDE transaction could not be completed because the request timed out.")); break;
	case SE_ERR_DLLNOTFOUND:     showerr(hWnd, _T("Cannot open site"), _T("The specified DLL was not found."));  break;
	case SE_ERR_FNF:             showerr(hWnd, _T("Cannot open site"), _T("The specified file was not found.")); break;
	case SE_ERR_NOASSOC:         showerr(hWnd, _T("Cannot open site"), _T("There is no application associated with the given file name extension. This error will also be returned if you attempt to print a file that is not printable.")); break;
	case SE_ERR_OOM:             showerr(hWnd, _T("Cannot open site"), _T("There was not enough memory to complete the operation."));    break;
	case SE_ERR_PNF:             showerr(hWnd, _T("Cannot open site"), _T("The specified path was not found.")); break;
	case SE_ERR_SHARE:           showerr(hWnd, _T("Cannot open site"), _T("A sharing violation occurred."));     break;
	default: showerr(hWnd, _T("Cannot open site"), _T("Unknown error."));     break;
	}
}