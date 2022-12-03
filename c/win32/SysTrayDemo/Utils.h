#pragma once

#include <Windows.h>

#define DEFLT_SIZE_WIDTH(rect)  (rect.right)
#define DEFLT_SIZE_HEIGHT(rect) (rect.bottom)


BOOL GetDefaultWindowSize(LPRECT rect);
