#!/usr/bin/env bash
set -x
openssl aes-256-cbc -K $encrypted_2fbddccfbf30_key -iv $encrypted_2fbddccfbf30_iv -in ./.travis/id_ed25519.enc -out ./.travis/id_ed25519 -d
cp ./.travis/id_ed25519 $HOME/.ssh/id_ed25519
chmod 600 $HOME/.ssh/id_ed25519
pip install --user ansible
$HOME/.local/bin/ansible-playbook ../.ansible/playbook.yml -i ../.ansible/hosts
