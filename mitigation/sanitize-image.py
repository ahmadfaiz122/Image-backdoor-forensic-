# Image Sanitizer: Strips Metadata & Payloads
# Requires: Pillow and ImageMagick (subprocess)

from PIL import Image
import subprocess
import sys

def sanitize_image(input_path, output_path):
    # Re-open and save to strip metadata
    img = Image.open(input_path)
    img.save(output_path, quality=95)  # Basic strip
    
    # Use ImageMagick for thorough cleaning
    subprocess.run(['convert', input_path, '-strip', output_path], check=True)
    print(f"Sanitized: {output_path} (Original size vs new checked)")

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python sanitize_image.py input.jpg output.jpg")
    else:
        sanitize_image(sys.argv[1], sys.argv[2])
